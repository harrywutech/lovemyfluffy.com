// @ts-check
const { test, expect } = require('@playwright/test');

/**
 * WooCommerce Customers API Contract Tests
 * Tests the GET /wp-json/wc/v3/customers endpoint
 */

test.describe('WooCommerce Customers API - GET /wp-json/wc/v3/customers', () => {
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

  test('should return 401 when no authentication provided', async () => {
    const unauthContext = await apiContext.newContext({ baseURL: baseURL });
    const response = await unauthContext.get('/wp-json/wc/v3/customers');
    expect(response.status()).toBe(401);
    await unauthContext.dispose();
  });

  test('should return 200 and customers array when authenticated', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/customers');
    expect(response.status()).toBe(200);
    const responseBody = await response.json();
    expect(Array.isArray(responseBody)).toBeTruthy();
  });

  test('should return customer with correct schema structure', async () => {
    const response = await apiContext.get('/wp-json/wc/v3/customers?per_page=1');
    expect(response.status()).toBe(200);
    const customers = await response.json();

    if (customers.length > 0) {
      const customer = customers[0];
      expect(customer).toHaveProperty('id');
      expect(customer).toHaveProperty('email');
      expect(customer).toHaveProperty('first_name');
      expect(customer).toHaveProperty('last_name');
      expect(customer).toHaveProperty('billing');
      expect(customer).toHaveProperty('shipping');
      expect(typeof customer.id).toBe('number');
      expect(typeof customer.email).toBe('string');
    }
  });
});