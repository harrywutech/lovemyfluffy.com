// @ts-check
const { test, expect } = require('@playwright/test');

/**
 * WooCommerce Orders API Contract Tests
 * Tests the POST /wp-json/wc/v3/orders endpoint
 */

test.describe('WooCommerce Orders API - POST /wp-json/wc/v3/orders', () => {
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
    const orderData = {
      payment_method: 'stripe',
      payment_method_title: 'Credit Card',
      set_paid: true,
      billing: {
        first_name: 'John',
        last_name: 'Doe',
        email: 'john.doe@example.com'
      },
      line_items: [
        {
          product_id: 1,
          quantity: 2
        }
      ]
    };
    const response = await unauthContext.post('/wp-json/wc/v3/orders', { data: orderData });
    expect(response.status()).toBe(401);
    await unauthContext.dispose();
  });

  test('should create order successfully with valid data', async () => {
    const orderData = {
      payment_method: 'stripe',
      payment_method_title: 'Credit Card via Stripe',
      set_paid: false,
      billing: {
        first_name: 'Jane',
        last_name: 'Smith',
        email: 'jane.smith@lovemyfluffy.com',
        phone: '555-123-4567',
        address_1: '123 Pet Lover Street',
        city: 'Pet City',
        state: 'CA',
        postcode: '90210',
        country: 'US'
      },
      shipping: {
        first_name: 'Jane',
        last_name: 'Smith',
        address_1: '123 Pet Lover Street',
        city: 'Pet City',
        state: 'CA',
        postcode: '90210',
        country: 'US'
      },
      line_items: [
        {
          product_id: 1,
          quantity: 1
        }
      ]
    };

    const response = await apiContext.post('/wp-json/wc/v3/orders', { data: orderData });
    expect(response.status()).toBe(201);

    const createdOrder = await response.json();
    expect(createdOrder).toHaveProperty('id');
    expect(createdOrder).toHaveProperty('status');
    expect(createdOrder).toHaveProperty('total');
    expect(createdOrder.payment_method).toBe('stripe');
  });
});