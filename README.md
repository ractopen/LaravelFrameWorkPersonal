<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php">
<img src="https://img.shields.io/badge/Database-SQLite-003B57?style=for-the-badge&logo=sqlite">
</p>

<p align="center">
  <a href="#overview">📋 Overview</a> •
  <a href="#setup-instructions">⚙️ Setup</a> •
  <a href="#what-i-did">📝 What I Did</a> •
  <a href="#how-it-works">🔧 How It Works</a> •
  <a href="#database-schema">🗄️ Database</a> •
  <a href="#tech-stack">🛠️ Tech Stack</a>
</p>

# Buy My Classmate Inc - E-Commerce Store

A simple e-commerce platform built with Laravel and SQLite for the OOP Finals project. Features offline QR code receipts, theme persistence, and animated Easter eggs.

---

## Overview <a name="overview"></a>

**Buy My Classmate Inc** is a Laravel-based e-commerce store that allows users to browse products, manage shopping carts with selective checkout, and complete purchases using an offline QR code system. The application includes a full-featured admin panel and unique UI enhancements like theme switching and animated backgrounds.

### Key Features
- 🛒 **Shopping Cart** with selective item checkout and quantity adjustment
- 📱 **Offline QR Codes** using data URIs (no internet required!)
- 🌓 **Dark/Light Mode** with user preference persistence
- ✨ **Easter Eggs**: Animated star/sakura backgrounds
- 📢 **Announcement System** with scrolling marquee
- 📬 **Inbox Messages** for admin-to-user communication
- 👤 **User Authentication** with unique username/email validation
- 🔐 **Admin Panel** for managing products, users, and content

---

## Setup Instructions <a name="setup-instructions"></a>

### Prerequisites
- PHP 8.1 or higher
- Composer

### Quick Setup

```bash
# Navigate to project directory
cd myapp

# Install dependencies
composer install

# Setup environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database file
touch database/database.sqlite

# Run migrations and seed database
php artisan migrate:fresh --seed

# Create storage symlink for image uploads
php artisan storage:link

# Start development server
php artisan serve
```

### Default Credentials
- **Admin Username**: `admin`
- **Admin Password**: `admin`

### Access Points
- **Shop**: http://127.0.0.1:8000
- **Admin Panel**: Login with admin credentials, then navigate to Admin link

---

## What I Did <a name="what-i-did"></a>

### Models & Database

```bash
# Created models with migrations
php artisan make:model User -m
php artisan make:model Item -m
php artisan make:model Cart -m
php artisan make:model CartItem -m
php artisan make:model Announcement -m
php artisan make:model InboxMessage -m
```

**Why SQLite?**
- ✅ No server setup required (file-based)
- ✅ Perfect for development and small projects
- ✅ Easy to backup (just copy the file)
- ✅ No configuration needed

**Why I removed `email_verified_at` and `remember_token`:**
- ❌ No email sending functionality in this project
- ❌ "Remember Me" feature not needed
- ✅ Simplifies the database schema
- ✅ Reduces unnecessary columns

**Why I removed `password_reset_tokens` and `sessions` tables:**
- ❌ No password reset feature implemented
- ✅ Using file-based sessions instead (simpler, no DB queries)
- ✅ Configured in `.env`: `SESSION_DRIVER=file`

### Controllers

```bash
# Created controllers
php artisan make:controller AuthController
php artisan make:controller ShopController
php artisan make:controller AdminController
```

**Why manual authentication instead of Laravel Breeze/Jetstream?**
- ✅ Full control over validation rules (unique username AND email)
- ✅ No password confirmation requirement (as requested)
- ✅ Custom redirect logic (admin → dashboard, user → shop)
- ✅ Lighter codebase without extra packages

### Frontend Assets

**Created custom JavaScript files:**
- `public/js/effects.js` - Star and Sakura animations
- `public/js/qrcode.min.js` - Offline QR code generation

**Why use vanilla JavaScript instead of a framework?**
- ✅ No build process needed
- ✅ Faster page loads (no large framework bundles)
- ✅ Easier to understand for beginners
- ✅ Perfect for simple interactions

**Why data URIs for QR codes?**
- ✅ Works 100% offline (no API calls)
- ✅ HTML embedded directly in QR code
- ✅ Phone can display receipt without internet
- ✅ No external dependencies

### Blade Templates

Created views for:
- Authentication (`login.blade.php`, `register.blade.php`)
- Shop (`index.blade.php`, `cart.blade.php`, `checkout.blade.php`)
- Admin (`dashboard.blade.php`)
- Layout (`layouts/app.blade.php`)
- Contact (`contact.blade.php`)

**Why Blade instead of Vue/React?**
- ✅ Server-side rendering (better SEO)
- ✅ No JavaScript build step
- ✅ Simpler deployment
- ✅ Laravel's native templating engine

---

## How It Works <a name="how-it-works"></a>

### 1. User Registration & Login

```php
// AuthController.php
public function register(Request $request)
{
    // Validate unique username AND email
    $request->validate([
        'username' => 'required|string|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|string', // No min length!
    ]);
    
    // Create user with hashed password
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    
    // Auto-login after registration
    Auth::login($user);
    
    return redirect()->route('shop.index');
}
```

**Why no password length requirement?**
- As per project requirements (user requested flexibility)
- Still uses bcrypt hashing for security

### 2. Shopping Cart with Selective Checkout

```php
// ShopController.php
public function checkout(Request $request)
{
    // Get selected items and their quantities
    $selectedIds = $request->input('selected_items', []);
    $quantities = $request->input('quantities', []);
    
    // Filter cart items based on selection
    $selectedItems = $cart->items->whereIn('id', $selectedIds)
        ->map(function($item) use ($quantities) {
            // Use submitted quantity
            if (isset($quantities[$item->id])) {
                $item->pivot->quantity = max(1, (int)$quantities[$item->id]);
            }
            return $item;
        });
    
    // Generate QR code with receipt
    // ...
}
```

**Why allow quantity changes at checkout?**
- ✅ Better UX (no need to go back to cart)
- ✅ Users can adjust before final purchase
- ✅ Common in modern e-commerce

**Why selective checkout (checkboxes)?**
- ✅ Users can buy some items now, save others for later
- ✅ More flexible than "buy all" approach
- ✅ Reduces cart abandonment

### 3. Offline QR Code System

```php
// Generate compact HTML receipt
$html = '<!DOCTYPE html><html>...receipt...</html>';

// Encode as data URI
$qrData = 'data:text/html,' . rawurlencode($html);

// QR library creates QR code
new QRCode(document.getElementById("qrcode"), {
    text: qrData,
    width: 200,
    height: 200
});
```

**How it works:**
1. PHP generates HTML receipt with order details
2. HTML is URL-encoded into a data URI
3. QR code contains the data URI
4. When scanned, phone opens the HTML directly
5. No internet needed - HTML is in the QR code itself!

**Why this approach?**
- ✅ Works offline (perfect for demos)
- ✅ No payment gateway needed
- ✅ Educational demonstration of data URIs
- ✅ Unique and impressive feature

### 4. Theme Persistence

```javascript
// When user toggles theme
toggleBtn.addEventListener('click', () => {
    const newTheme = body.classList.contains('dark-mode') ? 'light' : 'dark';
    
    // Save to localStorage (for guests)
    localStorage.setItem('theme', newTheme);
    
    // Save to database (for logged-in users)
    if (authenticated) {
        fetch('/theme', {
            method: 'POST',
            body: JSON.stringify({ theme: newTheme })
        });
    }
});
```

**Why save theme to database?**
- ✅ Persists across devices for logged-in users
- ✅ Better UX (theme follows the user)
- ✅ Falls back to localStorage for guests

### 5. Easter Egg System

```javascript
// Click "Inc" in logo to toggle
easterEggBtn.addEventListener('click', () => {
    const theme = body.classList.contains('dark-mode') ? 'dark' : 'light';
    
    if (theme === 'dark') {
        window.starBg.init(); // Falling stars
    } else {
        window.sakuraBg.init(); // Falling petals
    }
});
```

**Why different effects for each theme?**
- ✅ Stars fit dark mode aesthetic
- ✅ Sakura petals fit light mode aesthetic
- ✅ Adds polish and personality
- ✅ Fun discovery for users

### 6. Inbox System

```javascript
// Check localStorage for dismissed messages
const dismissedMessages = JSON.parse(localStorage.getItem('dismissedMessages') || '[]');

// Show only non-dismissed messages
document.querySelectorAll('.inbox-message').forEach(msg => {
    const id = parseInt(msg.dataset.id);
    if (!dismissedMessages.includes(id)) {
        msg.style.display = 'block';
    }
});
```

**Why use localStorage for dismissal?**
- ✅ No database writes needed
- ✅ Instant response (no server round-trip)
- ✅ Per-browser persistence (user can dismiss on phone, still see on desktop)
- ✅ Admin can still delete message from database

---

## Database Schema <a name="database-schema"></a>

### Tables Overview

| Table | Purpose | Key Relationships |
|-------|---------|-------------------|
| `users` | User accounts | Has many carts |
| `items` | Products for sale | Belongs to many carts |
| `carts` | Shopping sessions | Belongs to user, has many items |
| `cart_items` | Cart-item pivot | Links carts and items |
| `announcements` | Header messages | Standalone |
| `inbox_messages` | User notifications | Standalone |
| `migrations` | Laravel tracking | System table |

### Detailed Schema

#### `users` Table
```sql
CREATE TABLE users (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    username VARCHAR UNIQUE NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    is_admin BOOLEAN DEFAULT 0,
    password VARCHAR NOT NULL,
    theme VARCHAR DEFAULT 'light',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Why `theme` column?**
- Stores user's preferred theme (light/dark)
- Syncs across devices when logged in

**Why `is_admin` instead of roles table?**
- ✅ Simple boolean is sufficient for this project
- ✅ No need for complex role-based access control
- ✅ Easier to query: `WHERE is_admin = 1`

#### `items` Table
```sql
CREATE TABLE items (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image_path VARCHAR,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Why nullable `image_path`?**
- ✅ Items can exist without images
- ✅ Fallback emoji (📷) shown in UI
- ✅ Flexible for quick admin entry

#### `carts` Table
```sql
CREATE TABLE carts (
    id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    status VARCHAR DEFAULT 'active',
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

**Why `status` column?**
- Tracks cart state (active/completed)
- Could extend to: abandoned, pending, etc.
- Enables order history in future

#### `cart_items` Table (Pivot)
```sql
CREATE TABLE cart_items (
    id INTEGER PRIMARY KEY,
    cart_id INTEGER NOT NULL,
    item_id INTEGER NOT NULL,
    quantity INTEGER DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES carts(id),
    FOREIGN KEY (item_id) REFERENCES items(id)
);
```

**Why separate pivot table?**
- ✅ Many-to-many relationship (cart ↔ items)
- ✅ Stores quantity per item
- ✅ Laravel Eloquent best practice

#### `announcements` Table
```sql
CREATE TABLE announcements (
    id INTEGER PRIMARY KEY,
    message TEXT NOT NULL,
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Why `is_active` column?**
- Admin can disable without deleting
- Could schedule announcements in future
- Soft delete alternative

#### `inbox_messages` Table
```sql
CREATE TABLE inbox_messages (
    id INTEGER PRIMARY KEY,
    message TEXT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Why no user_id foreign key?**
- ✅ Messages are global (sent to all users)
- ✅ Dismissal tracked in browser (localStorage)
- ✅ Simpler than per-user message records

---

## Tech Stack <a name="tech-stack"></a>

### Backend
- **Framework**: Laravel 11.x
- **Language**: PHP 8.2+
- **Database**: SQLite (file-based)
- **Authentication**: Custom (manual implementation)
- **Session Storage**: File-based

### Frontend
- **Templating**: Blade (Laravel's engine)
- **Styling**: Vanilla CSS with CSS Variables
- **JavaScript**: Vanilla JS (no framework)
- **Fonts**: Google Fonts (Inter)

### Libraries & Tools
- **QR Code**: qrcode.min.js (client-side generation)
- **Version Control**: Git
- **Package Manager**: Composer

### Why These Choices?

**SQLite over MySQL/PostgreSQL:**
- ✅ Zero configuration
- ✅ Single file database
- ✅ Perfect for development
- ✅ Easy to share/backup

**File Sessions over Database:**
- ✅ Faster (no DB queries)
- ✅ Simpler setup
- ✅ Adequate for small apps

**Vanilla CSS over Tailwind:**
- ✅ Full control over styles
- ✅ No build process
- ✅ Easier to customize
- ✅ Better for learning

**Vanilla JS over Vue/React:**
- ✅ No compilation needed
- ✅ Faster page loads
- ✅ Simpler debugging
- ✅ Educational value

---

## Project Information

**Developer**: Royette Andrei C. Telar  
**Course**: CS21A | 2nd Year BSCS  
**Project**: Object Oriented Programming (OOP) Finals  

**Message from the Developer**:
> "This project was built with dedication for the Object Oriented Programming (OOP) Finals. It represents the culmination of hard work, sleepless nights, and a passion for coding. To my classmates and professors, thank you for the support and knowledge shared throughout this journey."

---

## License

This project is for educational purposes only.

<p align="center">Made with ❤️ for OOP Finals</p>
