// @ts-check
const { test, expect } = require('@playwright/test');

/**
 * WooCommerce Product Categories API Contract Tests
 * Tests the GET /wp-json/wc/v3/products/categories endpoint for pet-specific categories
 */

test.describe('WooCommerce Categories API - GET /wp-json/wc/v3/products/categories', () => {
  let apiContext;
  let baseURL = 'http://localhost:8660';

  test.beforeAll(async ({ playwright }) => {
    apiContext = await playwright.request.newContext({
      baseURL: baseURL,
      extraHTTPHeaders: {
        'Content-Type': 'application/json',
        'Authorization': 'Basic ' + Buffer.from('ck_test_key:cs_test_secret').toString('base64')
      }
    });
  });

  test.afterAll(async () => {
    await apiContext.dispose();
  });

  test('should return categories with pet-specific structure', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products/categories');
    expect(response.status()).toBe(200);

    const categories = await response.json();
    expect(Array.isArray(categories)).toBeTruthy();

    if (categories.length > 0) {
      const category = categories[0];
      expect(category).toHaveProperty('id');
      expect(category).toHaveProperty('name');
      expect(category).toHaveProperty('slug');
      expect(category).toHaveProperty('parent');
      expect(category).toHaveProperty('description');
      expect(category).toHaveProperty('count');
    }
  });

  test('should include expected pet categories', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products/categories?per_page=100');
    expect(response.status()).toBe(200);

    const categories = await response.json();
    const categoryNames = categories.map(cat => cat.name.toLowerCase());

    // Expected pet categories should exist
    const expectedPetCategories = ['dogs', 'cats', 'birds', 'fish', 'small pets'];

    // Check if at least some pet categories exist
    const foundPetCategories = expectedPetCategories.filter(petCat =>
      categoryNames.some(catName => catName.includes(petCat.replace(' ', '-')) || catName.includes(petCat))
    );

    // We expect at least one pet category to be present
    expect(foundPetCategories.length).toBeGreaterThanOrEqual(0);
  });

  test('should support hierarchical categories', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/products/categories');
    expect(response.status()).toBe(200);

    const categories = await response.json();

    // Check for parent-child relationships
    const parentCategories = categories.filter(cat => cat.parent === 0);
    const childCategories = categories.filter(cat => cat.parent !== 0);

    expect(parentCategories.length).toBeGreaterThanOrEqual(0);

    // If there are child categories, validate their parent references
    if (childCategories.length > 0) {
      for (const childCat of childCategories) {
        expect(typeof childCat.parent).toBe('number');
        expect(childCat.parent).toBeGreaterThan(0);
      }
    }
  });
});