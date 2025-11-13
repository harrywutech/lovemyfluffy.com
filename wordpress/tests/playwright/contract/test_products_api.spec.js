// @ts-check
const { test, expect } = require('@playwright/test');

/**
 * WooCommerce Products API Contract Tests
 * Tests the GET /wp-json/wc/v3/products endpoint
 */

test.describe('WooCommerce Products API - GET /wp-json/wc/v3/products', () => {
  let apiContext;
  let baseURL = 'http://localhost:8660';

  test.beforeAll(async ({ playwright }) => {
    // Create API context with WooCommerce authentication
    apiContext = await playwright.request.newContext({
      baseURL: baseURL,
      extraHTTPHeaders: {
        'Content-Type': 'application/json',
        // Note: In real implementation, these would come from environment variables
        'Authorization': 'Basic ' + Buffer.from('ck_test_key:cs_test_secret').toString('base64')
      }
    });
  });

  test.afterAll(async () => {
    await apiContext.dispose();
  });

  test('should return 401 when no authentication provided', async () => {
    const unauthContext = await apiContext.newContext({
      baseURL: baseURL
    });

    const response = await unauthContext.get('/wp-json/wc/v3/products');

    expect(response.status()).toBe(401);

    const responseBody = await response.json();
    expect(responseBody).toHaveProperty('code', 'woocommerce_rest_cannot_view');
    expect(responseBody).toHaveProperty('message');
    expect(responseBody.message).toContain('Sorry, you cannot list resources');

    await unauthContext.dispose();
  });

  test('should return 200 and products array when authenticated', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products');

    // Test will fail initially as WordPress/WooCommerce is not yet installed
    // This is expected behavior for TDD approach
    expect(response.status()).toBe(200);

    const responseBody = await response.json();
    expect(Array.isArray(responseBody)).toBeTruthy();
  });

  test('should return products with correct schema structure', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products?per_page=1');

    expect(response.status()).toBe(200);

    const products = await response.json();

    if (products.length > 0) {
      const product = products[0];

      // Validate required product fields
      expect(product).toHaveProperty('id');
      expect(product).toHaveProperty('name');
      expect(product).toHaveProperty('slug');
      expect(product).toHaveProperty('description');
      expect(product).toHaveProperty('short_description');
      expect(product).toHaveProperty('sku');
      expect(product).toHaveProperty('price');
      expect(product).toHaveProperty('regular_price');
      expect(product).toHaveProperty('stock_quantity');
      expect(product).toHaveProperty('stock_status');
      expect(product).toHaveProperty('categories');
      expect(product).toHaveProperty('images');

      // Validate data types
      expect(typeof product.id).toBe('number');
      expect(typeof product.name).toBe('string');
      expect(typeof product.slug).toBe('string');
      expect(Array.isArray(product.categories)).toBeTruthy();
      expect(Array.isArray(product.images)).toBeTruthy();

      // Validate stock status enum
      expect(['instock', 'outofstock', 'onbackorder']).toContain(product.stock_status);
    }
  });

  test('should support pagination parameters', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products?page=1&per_page=5');

    expect(response.status()).toBe(200);

    const products = await response.json();
    expect(Array.isArray(products)).toBeTruthy();
    expect(products.length).toBeLessThanOrEqual(5);

    // Check pagination headers
    const totalCount = response.headers()['x-wp-total'];
    const totalPages = response.headers()['x-wp-totalpages'];

    if (totalCount) {
      expect(parseInt(totalCount)).toBeGreaterThanOrEqual(0);
    }

    if (totalPages) {
      expect(parseInt(totalPages)).toBeGreaterThanOrEqual(0);
    }
  });

  test('should support category filtering', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products?category=dogs');

    expect(response.status()).toBe(200);

    const products = await response.json();
    expect(Array.isArray(products)).toBeTruthy();

    // If products exist, verify they belong to the specified category
    if (products.length > 0) {
      for (const product of products) {
        const hasDogsCategory = product.categories.some(
          category => category.slug === 'dogs' || category.name.toLowerCase().includes('dogs')
        );
        expect(hasDogsCategory).toBeTruthy();
      }
    }
  });

  test('should support search functionality', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products?search=food');

    expect(response.status()).toBe(200);

    const products = await response.json();
    expect(Array.isArray(products)).toBeTruthy();

    // If products exist, verify search term appears in name or description
    if (products.length > 0) {
      for (const product of products) {
        const searchTerm = 'food';
        const inName = product.name.toLowerCase().includes(searchTerm);
        const inDescription = product.description.toLowerCase().includes(searchTerm);
        const inShortDescription = product.short_description.toLowerCase().includes(searchTerm);

        expect(inName || inDescription || inShortDescription).toBeTruthy();
      }
    }
  });

  test('should handle invalid parameters gracefully', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products?per_page=invalid');

    // Should either return 400 or default to valid per_page value
    expect([200, 400]).toContain(response.status());

    if (response.status() === 200) {
      const products = await response.json();
      expect(Array.isArray(products)).toBeTruthy();
    }
  });

  test('should return CORS headers for cross-origin requests', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products', {
      headers: {
        'Origin': 'https://example.com'
      }
    });

    expect(response.status()).toBe(200);

    // Check for CORS headers
    const headers = response.headers();
    expect(headers).toHaveProperty('access-control-allow-origin');
  });

  test('should have proper rate limiting headers', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products');

    expect(response.status()).toBe(200);

    // WooCommerce might include rate limiting headers
    const headers = response.headers();

    // These headers may or may not be present depending on configuration
    if (headers['x-ratelimit-limit']) {
      expect(parseInt(headers['x-ratelimit-limit'])).toBeGreaterThan(0);
    }

    if (headers['x-ratelimit-remaining']) {
      expect(parseInt(headers['x-ratelimit-remaining'])).toBeGreaterThanOrEqual(0);
    }
  });
});