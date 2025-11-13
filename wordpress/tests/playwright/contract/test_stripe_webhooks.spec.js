// @ts-check
const { test, expect } = require('@playwright/test');

/**
 * Stripe Webhook Contract Tests
 * Tests the Stripe webhook endpoint for payment processing
 */

test.describe('Stripe Webhook - payment_intent.succeeded', () => {
  let apiContext;
  let baseURL = 'http://localhost:8660';

  test.beforeAll(async ({ playwright }) => {
    apiContext = await playwright.request.newContext({
      baseURL: baseURL,
      extraHTTPHeaders: {
        'Content-Type': 'application/json',
        'Stripe-Signature': 'test_signature'
      }
    });
  });

  test.afterAll(async () => {
    await apiContext.dispose();
  });

  test('should handle payment_intent.succeeded webhook', async () => {
    const webhookPayload = {
      id: 'evt_test_webhook',
      object: 'event',
      type: 'payment_intent.succeeded',
      created: Math.floor(Date.now() / 1000),
      data: {
        object: {
          id: 'pi_test_payment_intent',
          object: 'payment_intent',
          amount: 2999,
          currency: 'usd',
          status: 'succeeded',
          metadata: {
            order_id: '123',
            customer_id: '456'
          }
        }
      },
      livemode: false
    };

    const response = await apiContext.post('/wp-json/stripe/v1/webhooks', {
      data: webhookPayload
    });

    // Test will fail initially as webhook endpoint is not yet implemented
    expect(response.status()).toBe(200);

    const responseBody = await response.json();
    expect(responseBody).toHaveProperty('received', true);
  });

  test('should reject invalid webhook signature', async () => {
    const invalidContext = await apiContext.newContext({
      baseURL: baseURL,
      extraHTTPHeaders: {
        'Content-Type': 'application/json',
        'Stripe-Signature': 'invalid_signature'
      }
    });

    const webhookPayload = {
      id: 'evt_test_webhook',
      object: 'event',
      type: 'payment_intent.succeeded'
    };

    const response = await invalidContext.post('/wp-json/stripe/v1/webhooks', {
      data: webhookPayload
    });

    expect(response.status()).toBe(401);
    await invalidContext.dispose();
  });
});