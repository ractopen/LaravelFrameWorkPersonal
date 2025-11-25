# Laravel E-Commerce Documentation

## Overview
This project is a Laravel-based e-commerce platform for buying and selling "classmates" as items. It features user authentication, shopping cart, checkout with QR code receipts, admin panel, announcements, inbox messages, and theme persistence.

---

## Models

### User
- **Fields:** id, name, username, email, password, is_admin, theme, timestamps
- **Relationships:**
  - `carts()`: Has many carts
- **Cascade Soft Delete:**
  - When a user is deleted, all their carts, cart items, and related items are soft deleted.
- **Methods:**
  - `carts()`: Returns user's carts
  - `booted()`: Handles cascade soft delete

### Cart
- **Fields:** id, user_id, status, timestamps
- **Relationships:**
  - `cartItems()`: Has many cart items
  - `items()`: Belongs to many items (via cart_items)
- **Cascade Soft Delete:**
  - When a cart is deleted, all its cart items and related items are soft deleted.
- **Methods:**
  - `cartItems()`: Returns cart's items
  - `booted()`: Handles cascade soft delete

### CartItem
- **Fields:** id, cart_id, item_id, quantity, timestamps
- **Relationships:**
  - `cart()`: Belongs to cart
  - `item()`: Belongs to item

### Item
- **Fields:** id, name, price, description, image_path, stock, timestamps
- **Relationships:**
  - `cartItems()`: Has many cart items
- **Cascade Soft Delete:**
  - When an item is deleted, all its cart items and related carts are soft deleted.
- **Methods:**
  - `cartItems()`: Returns item's cart items
  - `booted()`: Handles cascade soft delete

### Announcement
- **Fields:** id, message, is_active, timestamps

### InboxMessage
- **Fields:** id, message, timestamps

---

## Controllers

### AuthController
- Handles user registration, login, logout, and theme update.
- **register(Request $request):** Validates and creates a new user.
- **login(Request $request):** Authenticates user.
- **logout():** Logs out user.
- **updateTheme(Request $request):** Updates user's theme.

### ShopController
- Handles shop browsing, cart management, buying, and checkout.
- **index():** Shows shop items.
- **addToCart(Request $request, Item $item):** Adds item to cart.
- **viewCart():** Shows user's cart.
- **deleteFromCart(Item $item):** Removes item from cart.
- **buyNow(Request $request, Item $item):** Adds item to cart and redirects to checkout.
- **singleCheckout(Request $request, Item $item):** Shows checkout for a single item and quantity.
- **checkout(Request $request):** Handles cart checkout with selected items and quantities.
- **completeOrder(Request $request):** Finalizes order, deducts stock, and removes items from cart.

### AdminController
- Handles admin dashboard, item/user management, announcements, and inbox messages.
- **dashboard():** Shows admin dashboard.
- **storeItem(Request $request):** Adds new item.
- **updateItem(Request $request, Item $item):** Updates item.
- **deleteItem(Item $item):** Deletes item.
- **deleteUser(User $user):** Deletes user.
- **storeAnnouncement(Request $request):** Adds announcement.
- **deleteAnnouncement(Announcement $announcement):** Deletes announcement.
- **storeInboxMessage(Request $request):** Adds inbox message.
- **deleteInboxMessage(InboxMessage $inboxMessage):** Deletes inbox message.

---

## Routes

- `/` - Shop index
- `/register` - User registration
- `/login` - User login
- `/cart` - View cart
- `/cart/add/{item}` - Add item to cart
- `/cart/delete/{item}` - Remove item from cart
- `/buy-now/{item}` - Buy now (add to cart and checkout)
- `/buy-now/{item}/checkout` - Single item checkout
- `/checkout` - Cart checkout
- `/checkout/complete` - Complete order
- `/admin/dashboard` - Admin dashboard
- `/admin/items` - Manage items
- `/admin/users` - Manage users
- `/admin/announcements` - Manage announcements
- `/admin/inbox` - Manage inbox messages

---

## Cascade Soft Delete Logic

- When a User is soft deleted, all their Carts, CartItems, and related Items are soft deleted.
- When a Cart is soft deleted, all its CartItems and related Items are soft deleted.
- When an Item is soft deleted, all its CartItems and related Carts are soft deleted.
- Relationships in CartItem allow traversing to both Cart and Item for deep cascade.

---

## Blade Views

- `shop/index.blade.php` - Shop browsing and buying
- `shop/cart.blade.php` - Cart management
- `shop/checkout.blade.php` - Checkout and QR code receipt
- `auth/login.blade.php` - Login
- `auth/register.blade.php` - Register
- `admin/dashboard.blade.php` - Admin panel
- `contact.blade.php` - Contact page
- `layouts/app.blade.php` - Main layout

---

## Other Features

- **Theme Persistence:** User theme saved in DB and localStorage
- **QR Code Receipts:** Offline QR code with order details
- **Inbox System:** Admin messages, dismissible via localStorage
- **Announcement System:** Marquee for active announcements
- **Easter Eggs:** Animated backgrounds for fun

---

## How to Understand the Code
- Each model and controller is documented above with its main functions and relationships.
- Cascade logic is implemented in the `booted()` method of models.
- Blade views are organized by feature (shop, cart, checkout, admin, auth).
- All routes are defined in `routes/web.php` and grouped by feature.

---

## For More Info
- See comments in each model/controller for further details.
- Explore Blade views for UI logic and interactions.
- Review migration files for database structure.

---

## UI & User Flow

### Shop Browsing
- Users see a grid of items with images, names, descriptions, prices, and stock.
- Each item has a "Cart" button and a "Buy" button.
- "Buy" prompts for quantity, then takes user directly to checkout for that item.

### Cart
- Users can add items to their cart and view all items in their cart.
- Cart page allows removing items and adjusting quantities.

### Checkout
- Checkout page displays selected items, quantities, and total price.
- Generates a QR code containing the order receipt (offline, data URI).
- User must enter a 4-digit verification code from the QR to complete the order.
- If the code is incorrect, a popup alert says "Verification not succeeded. Please enter the correct 4-digit code from the QR."

### Admin Panel
- Admins can add, update, and delete items and users.
- Admins can post announcements and inbox messages.

### Theme & Effects
- Users can toggle dark/light mode; theme is saved in DB and localStorage.
- Clicking "Inc" in the logo triggers animated backgrounds (stars for dark, sakura for light).

### Announcements & Inbox
- Announcements appear as a scrolling marquee.
- Inbox messages can be dismissed (tracked in localStorage).

---

## Data Flow & Interactions
- All actions (add to cart, buy, checkout, admin changes) are handled via POST requests for security.
- Cascade soft deletes ensure all related data is hidden but not removed from the database.
- QR code receipts work offline and encode order details for easy sharing.
- Verification code is required to complete checkout, ensuring user confirmation.

---

Made for OOP Finals by Royette Andrei C. Telar
