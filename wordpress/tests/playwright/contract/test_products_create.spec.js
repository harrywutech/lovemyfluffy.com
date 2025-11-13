// @ts-check
const { test, expect } = require('@playwright/test');

/**
 * WooCommerce Products API Contract Tests
 * Tests the POST /wp-json/wc/v3/products endpoint
 */

test.describe('WooCommerce Products API - POST /wp-json/wc/v3/products', () => {
  let apiContext;
  let baseURL = 'http://localhost:8660';
  let createdProductIds = [];

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
    // Clean up created products
    for (const productId of createdProductIds) {
      try {
        await apiContext.delete(`/wp-json/wc/v3/products/${productId}?force=true`);
      } catch (error) {
        console.log(`Failed to cleanup product ${productId}:`, error);
      }
    }
    await apiContext.dispose();
  });

  test('should return 401 when no authentication provided', async () => {
    const unauthContext = await apiContext.newContext({
      baseURL: baseURL
    });

    const productData = {
      name: 'Test Product',
      type: 'simple',
      regular_price: '19.99'
    };

    const response = await unauthContext.post('/wp-json/wc/v3/products', {
      data: productData
    });

    expect(response.status()).toBe(401);

    const responseBody = await response.json();
    expect(responseBody).toHaveProperty('code', 'woocommerce_rest_cannot_create');
    expect(responseBody).toHaveProperty('message');
    expect(responseBody.message).toContain('Sorry, you are not allowed to create resources');

    await unauthContext.dispose();
  });

  test('should create a basic pet product successfully', async () => {
    const productData = {
      name: 'Premium Dog Food - Chicken & Rice',
      type: 'simple',
      regular_price: '29.99',
      description: 'High-quality dog food made with real chicken and brown rice. Perfect for adult dogs of all sizes.',
      short_description: 'Premium dog food with chicken and rice',
      sku: 'DOG-FOOD-001',
      stock_quantity: 100,
      stock_status: 'instock',
      categories: [
        { name: 'Dogs' },
        { name: 'Food' }
      ],
      attributes: [
        {
          name: 'Pet Size',
          options: ['Small', 'Medium', 'Large'],
          visible: true,
          variation: false
        },
        {
          name: 'Pet Age Group',
          options: ['Adult'],
          visible: true,
          variation: false
        }
      ],
      weight: '5',
      dimensions: {
        length: '12',
        width: '8',
        height: '16'
      }
    };

    const response = await apiContext.post('/wp-json/wc/v3/products', {
      data: productData
    });

    // Test will fail initially as WordPress/WooCommerce is not yet installed
    // This is expected behavior for TDD approach
    expect(response.status()).toBe(201);

    const createdProduct = await response.json();

    // Store for cleanup
    createdProductIds.push(createdProduct.id);

    // Validate response structure
    expect(createdProduct).toHaveProperty('id');
    expect(createdProduct).toHaveProperty('name', productData.name);
    expect(createdProduct).toHaveProperty('type', productData.type);
    expect(createdProduct).toHaveProperty('regular_price', productData.regular_price);
    expect(createdProduct).toHaveProperty('sku', productData.sku);
    expect(createdProduct).toHaveProperty('stock_quantity', productData.stock_quantity);
    expect(createdProduct).toHaveProperty('stock_status', productData.stock_status);

    // Validate categories were assigned
    expect(Array.isArray(createdProduct.categories)).toBeTruthy();
    expect(createdProduct.categories.length).toBeGreaterThan(0);

    // Validate attributes were assigned
    expect(Array.isArray(createdProduct.attributes)).toBeTruthy();
    expect(createdProduct.attributes.length).toBeGreaterThan(0);
  });

  test('should create a cat product with variations', async () => {
    const productData = {
      name: 'Cat Litter - Clumping Clay',
      type: 'variable',
      description: 'Premium clumping clay litter for cats. Available in different sizes.',
      short_description: 'Premium clumping cat litter',
      sku: 'CAT-LITTER-001',
      categories: [
        { name: 'Cats' },
        { name: 'Litter' }
      ],
      attributes: [
        {
          name: 'Size',
          options: ['10lb', '20lb', '40lb'],
          visible: true,
          variation: true
        },
        {
          name: 'Scent',
          options: ['Unscented', 'Fresh Scent'],
          visible: true,
          variation: true
        }
      ]
    };

    const response = await apiContext.post('/wp-json/wc/v3/products', {
      data: productData
    });

    expect(response.status()).toBe(201);

    const createdProduct = await response.json();
    createdProductIds.push(createdProduct.id);

    expect(createdProduct.type).toBe('variable');
    expect(createdProduct.name).toBe(productData.name);

    // Variable products should have attributes for variations
    expect(Array.isArray(createdProduct.attributes)).toBeTruthy();
    expect(createdProduct.attributes.length).toBe(2);

    // Check that attributes are marked for variation
    const variationAttributes = createdProduct.attributes.filter(attr => attr.variation === true);
    expect(variationAttributes.length).toBe(2);
  });

  test('should create a bird product with specific attributes', async () => {
    const productData = {
      name: 'Bird Cage - Large Flight Cage',
      type: 'simple',
      regular_price: '199.99',
      sale_price: '149.99',
      description: 'Spacious flight cage perfect for multiple birds or large species.',
      short_description: 'Large flight cage for birds',
      sku: 'BIRD-CAGE-001',
      stock_quantity: 25,
      stock_status: 'instock',
      categories: [
        { name: 'Birds' },
        { name: 'Cages' }
      ],
      attributes: [
        {
          name: 'Cage Size',
          options: ['Large'],
          visible: true,
          variation: false
        },
        {
          name: 'Material',
          options: ['Powder-coated Steel'],
          visible: true,
          variation: false
        }
      ],
      weight: '45',
      dimensions: {
        length: '48',
        width: '24',
        height: '36'
      }
    };

    const response = await apiContext.post('/wp-json/wc/v3/products', {
      data: productData
    });

    expect(response.status()).toBe(201);

    const createdProduct = await response.json();
    createdProductIds.push(createdProduct.id);

    // Validate sale price is applied
    expect(createdProduct.sale_price).toBe(productData.sale_price);
    expect(createdProduct.regular_price).toBe(productData.regular_price);
    expect(createdProduct.price).toBe(productData.sale_price); // Current price should be sale price

    // Validate dimensions for shipping
    expect(createdProduct.dimensions).toHaveProperty('length', productData.dimensions.length);
    expect(createdProduct.dimensions).toHaveProperty('width', productData.dimensions.width);
    expect(createdProduct.dimensions).toHaveProperty('height', productData.dimensions.height);
  });

  test('should validate required fields', async () => {
    const invalidProductData = {
      // Missing required 'name' field
      type: 'simple',
      regular_price: '19.99'
    };

    const response = await apiContext.post('/wp-json/wc/v3/products', {
      data: invalidProductData
    });

    expect(response.status()).toBe(400);

    const responseBody = await response.json();
    expect(responseBody).toHaveProperty('code');
    expect(responseBody).toHaveProperty('message');
    expect(responseBody.message).toContain('name');
  });

  test('should validate price format', async () => {
    const productData = {
      name: 'Test Product',
      type: 'simple',
      regular_price: 'invalid_price' // Invalid price format
    };

    const response = await apiContext.post('/wp-json/wc/v3/products', {
      data: productData
    });

    // Should return 400 for invalid price or convert to valid format
    expect([400, 201]).toContain(response.status());

    if (response.status() === 400) {
      const responseBody = await response.json();
      expect(responseBody).toHaveProperty('code');
      expect(responseBody).toHaveProperty('message');
    }
  });

  test('should handle duplicate SKU validation', async () => {
    const sku = 'DUPLICATE-SKU-TEST';

    // Create first product
    const firstProductData = {
      name: 'First Product',
      type: 'simple',
      regular_price: '19.99',
      sku: sku
    };

    const firstResponse = await apiContext.post('/wp-json/wc/v3/products', {
      data: firstProductData
    });

    expect(firstResponse.status()).toBe(201);
    const firstProduct = await firstResponse.json();
    createdProductIds.push(firstProduct.id);

    // Try to create second product with same SKU
    const secondProductData = {
      name: 'Second Product',
      type: 'simple',
      regular_price: '29.99',
      sku: sku // Duplicate SKU
    };

    const secondResponse = await apiContext.post('/wp-json/wc/v3/products', {
      data: secondProductData
    });

    expect(secondResponse.status()).toBe(400);

    const responseBody = await secondResponse.json();
    expect(responseBody).toHaveProperty('code');
    expect(responseBody.message).toContain('SKU');
  });

  test('should create product with images', async () => {
    const productData = {
      name: 'Fish Tank - 20 Gallon',
      type: 'simple',
      regular_price: '89.99',
      description: 'Perfect starter tank for tropical fish.',
      sku: 'FISH-TANK-001',
      categories: [
        { name: 'Fish' },
        { name: 'Tanks' }
      ],
      images: [
        {
          src: 'https://example.com/fish-tank-1.jpg',
          name: 'Fish Tank Front View',
          alt: '20 gallon fish tank front view'
        },
        {
          src: 'https://example.com/fish-tank-2.jpg',
          name: 'Fish Tank Side View',
          alt: '20 gallon fish tank side view'
        }
      ]
    };

    const response = await apiContext.post('/wp-json/wc/v3/products', {
      data: productData
    });

    expect(response.status()).toBe(201);

    const createdProduct = await response.json();
    createdProductIds.push(createdProduct.id);

    // Validate images were assigned
    expect(Array.isArray(createdProduct.images)).toBeTruthy();
    expect(createdProduct.images.length).toBe(2);

    createdProduct.images.forEach((image, index) => {
      expect(image).toHaveProperty('src');
      expect(image).toHaveProperty('name');
      expect(image).toHaveProperty('alt');
      expect(image.src).toBe(productData.images[index].src);
    });
  });
});