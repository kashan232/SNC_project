# Checkout Form Redesign & Dynamic Delivery Tracking

This plan outlines the changes needed to replace the old static address fields on the checkout page with the new dynamic **City & Area** system, and track this data properly for dashboard analytics.

## User Review Required
> [!IMPORTANT]
> The current `orders` table uses free-text fields like `country`, `post_code`, `address1`, and `address2`. I propose removing `country`, `post_code`, and `address2` from the checkout form, and replacing them with dynamic `City` and `Area` dropdowns. `address1` will be renamed to "Street Address / House No." for specific location details.

## Proposed Changes

### Database Modifications
#### [NEW] `database/migrations/xxxx_add_city_area_to_orders_table.php`
- Add `city_id` and `area_id` columns (foreign keys referencing `cities` and `areas` tables) to the `orders` table.

### Model & Controller Updates
#### [MODIFY] `app/Models/Order.php`
- Add `city_id` and `area_id` to `$fillable`.
- Add `belongsTo` relationships for `City` and `Area`.

#### [MODIFY] `app/Http/Controllers/OrderController.php`
- In the `store` method, validate `city_id` and `area_id` instead of `country` and `post_code`.
- Save `city_id` and `area_id` when creating the order.

### Frontend Checkout Redesign
#### [MODIFY] `resources/views/frontend/pages/checkout.blade.php`
- Remove the `Country`, `Address Line 2`, and `Postal Code` fields.
- Rename `Address Line 1` to `House No. / Street Address`.
- Add a **City** dropdown populated with active cities from the database.
- Add an **Area** dropdown that dynamically populates via AJAX when a City is selected (re-using the logic from the delivery modal).
- Remove the Newsletter section include from the bottom of the checkout page to keep the design clean.

### Admin Dashboard (Order View)
#### [MODIFY] `resources/views/backend/order/show.blade.php`
- Update the order details view in the Admin panel to display the selected City and Area instead of the old country/postal code fields.

## Verification Plan
1. Add items to cart and proceed to Checkout.
2. Verify the Newsletter section is gone and the form looks cleaner.
3. Select a City and ensure the Area dropdown populates correctly.
4. Submit the order and verify it saves successfully.
5. Go to the Admin Panel -> Orders, and verify the order shows the correct City and Area.
