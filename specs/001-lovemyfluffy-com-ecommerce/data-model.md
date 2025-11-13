# Data Model: LoveMyFluffy E-commerce

**Date**: 2025-09-28
**Phase**: 1 - Data Design and Entity Relationships

## Core Entities

### Product
Pet supply items with comprehensive attributes for e-commerce operations.

**Attributes**:
- `id`: Unique product identifier (WordPress post ID)
- `name`: Product display name
- `description`: Detailed product description with pet care information
- `short_description`: Brief product summary for listings
- `price`: Base price (decimal, 2 places)
- `sale_price`: Discounted price (optional)
- `sku`: Stock Keeping Unit for inventory tracking
- `stock_quantity`: Available inventory count
- `stock_status`: Enumeration (in_stock, out_of_stock, on_backorder)
- `images`: Array of product image URLs
- `weight`: Product weight for shipping calculations
- `dimensions`: Length, width, height for shipping
- `category_ids`: Array of category references
- `tags`: Array of product tags for search/filtering
- `attributes`: Pet-specific attributes (size, age_group, species)
- `created_at`: Product creation timestamp
- `updated_at`: Last modification timestamp
- `status`: Publication status (published, draft, private)

**Relationships**:
- Belongs to multiple Categories (many-to-many)
- Has many OrderItems
- Has many Reviews
- Has many InventoryTransactions

### Customer
User accounts with authentication and profile information.

**Attributes**:
- `id`: Unique customer identifier (WordPress user ID)
- `email`: Login email address (unique)
- `username`: Display username
- `first_name`: Customer first name
- `last_name`: Customer last name
- `phone`: Contact phone number
- `date_of_birth`: Customer birth date (optional)
- `billing_address`: Billing address object
- `shipping_address`: Default shipping address object
- `created_at`: Account creation timestamp
- `last_login`: Last authentication timestamp
- `status`: Account status (active, suspended, deleted)

**Relationships**:
- Has many Orders
- Has many Addresses
- Has many Reviews
- Has many WishlistItems

### Order
Purchase transactions with complete order lifecycle management.

**Attributes**:
- `id`: Unique order identifier
- `order_number`: Human-readable order number
- `customer_id`: Reference to Customer
- `status`: Order status (pending, processing, shipped, delivered, cancelled)
- `total_amount`: Final order total including tax and shipping
- `subtotal`: Products total before tax and shipping
- `tax_amount`: Calculated tax amount
- `shipping_amount`: Shipping cost
- `discount_amount`: Applied discount value
- `currency`: ISO currency code (USD)
- `payment_method`: Payment method used
- `payment_status`: Payment processing status
- `billing_address`: Order billing address
- `shipping_address`: Order shipping address
- `order_notes`: Customer order notes
- `admin_notes`: Internal administrative notes
- `created_at`: Order creation timestamp
- `updated_at`: Last order modification
- `shipped_at`: Shipping timestamp
- `delivered_at`: Delivery confirmation timestamp

**Relationships**:
- Belongs to Customer
- Has many OrderItems
- Has one Payment
- Has many OrderStatusHistories

### OrderItem
Individual products within an order with quantities and pricing.

**Attributes**:
- `id`: Unique order item identifier
- `order_id`: Reference to Order
- `product_id`: Reference to Product
- `product_name`: Product name at time of order
- `product_sku`: Product SKU at time of order
- `quantity`: Ordered quantity
- `unit_price`: Price per unit at time of order
- `total_price`: Line total (quantity × unit_price)
- `product_attributes`: Captured product attributes

**Relationships**:
- Belongs to Order
- References Product (may be soft reference for deleted products)

### Payment
Financial transaction records for order payments.

**Attributes**:
- `id`: Unique payment identifier
- `order_id`: Reference to Order
- `stripe_payment_intent_id`: Stripe PaymentIntent ID
- `stripe_charge_id`: Stripe Charge ID
- `amount`: Payment amount
- `currency`: Payment currency
- `status`: Payment status (pending, succeeded, failed, cancelled)
- `payment_method_type`: Type of payment method (card, apple_pay, google_pay)
- `last_four`: Last four digits of payment method
- `card_brand`: Credit card brand (visa, mastercard, etc.)
- `created_at`: Payment initiation timestamp
- `processed_at`: Payment completion timestamp
- `failure_reason`: Reason for payment failure (if applicable)

**Relationships**:
- Belongs to Order
- Has many PaymentLogs

### Category
Hierarchical organization structure for pet supply products.

**Attributes**:
- `id`: Unique category identifier
- `name`: Category display name
- `slug`: URL-friendly category identifier
- `description`: Category description
- `parent_id`: Reference to parent category (for hierarchy)
- `image`: Category display image
- `sort_order`: Display order weight
- `is_active`: Category visibility status
- `meta_title`: SEO meta title
- `meta_description`: SEO meta description

**Pet-Specific Categories**:
- Dogs (Food, Toys, Health, Accessories)
- Cats (Food, Litter, Toys, Health)
- Birds (Food, Cages, Toys, Health)
- Fish (Food, Tanks, Filters, Decorations)
- Small Pets (Food, Habitats, Bedding, Toys)

**Relationships**:
- Has many Products (many-to-many)
- Has many child Categories
- Belongs to parent Category (optional)

### Inventory
Stock level tracking and management system.

**Attributes**:
- `id`: Unique inventory record identifier
- `product_id`: Reference to Product
- `location`: Storage location identifier
- `quantity_on_hand`: Current stock quantity
- `quantity_reserved`: Quantity allocated to pending orders
- `quantity_available`: Available for sale (on_hand - reserved)
- `reorder_level`: Minimum stock level trigger
- `reorder_quantity`: Suggested reorder amount
- `last_updated`: Last inventory update timestamp
- `notes`: Inventory management notes

**Relationships**:
- Belongs to Product
- Has many InventoryTransactions

### Address
Customer shipping and billing address management.

**Attributes**:
- `id`: Unique address identifier
- `customer_id`: Reference to Customer
- `type`: Address type (billing, shipping)
- `first_name`: Recipient first name
- `last_name`: Recipient last name
- `company`: Company name (optional)
- `address_line_1`: Street address
- `address_line_2`: Apartment/suite (optional)
- `city`: City name
- `state`: State/province
- `postal_code`: ZIP/postal code
- `country`: ISO country code
- `phone`: Contact phone number
- `is_default`: Default address flag

**Relationships**:
- Belongs to Customer

## Entity Relationship Diagram

```
Customer ||--o{ Order : places
Customer ||--o{ Address : has
Customer ||--o{ Review : writes

Order ||--o{ OrderItem : contains
Order ||--|| Payment : processed_by
Order ||--o{ OrderStatusHistory : tracked_by

Product ||--o{ OrderItem : ordered_in
Product ||--o{ Review : reviewed_in
Product }|--|| Inventory : tracked_by
Product }o--o{ Category : categorized_in

Category ||--o{ Category : contains (self-referential)

Payment ||--o{ PaymentLog : logged_in
Inventory ||--o{ InventoryTransaction : recorded_in
```

## Data Validation Rules

### Product Validation
- Price must be positive decimal
- Stock quantity must be non-negative integer
- SKU must be unique across all products
- At least one category assignment required
- Product images must be valid URLs or file paths

### Customer Validation
- Email must be unique and valid format
- Phone number must follow international format
- Birth date must be in the past
- Password must meet security requirements

### Order Validation
- Total amount must equal sum of items + tax + shipping - discounts
- Customer must exist and be active
- All order items must reference existing products
- Shipping address must be complete for physical products

### Payment Validation
- Amount must match order total
- Stripe IDs must be valid and unique
- Currency must be supported (USD initially)
- Payment method must be authorized

## Data Security and Privacy

### Personal Data Protection
- Customer email and personal information encrypted at rest
- Payment data handled through Stripe (PCI compliant)
- Address information secured with access controls
- Order history protected by customer authentication

### Data Retention Policies
- Customer accounts: Retained until deletion request
- Order history: 7 years for financial records
- Payment logs: 3 years for dispute resolution
- Product reviews: Indefinite (anonymized if customer deleted)

**Data Model Status**: COMPLETE
**Next**: API Contracts and Test Generation