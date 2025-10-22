# Aimeos Laravel E-commerce Setup Guide

Complete guide to setting up the Aimeos Laravel e-commerce application from scratch.

**Repository:** https://github.com/aimeos/aimeos

## 📋 Prerequisites

Before you begin, make sure you have:

- **PHP** >= 8.1
- **Composer** (PHP package manager)
- **Node.js & npm** (for frontend assets)
- **MySQL/MariaDB** database server
- **Git**

## 🚀 Setup Steps

### Step 1: Clone the Repository

```bash
cd /home/ract/All/School/OOP
git clone https://github.com/aimeos/aimeos.git aimeos-shop
cd aimeos-shop
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Update database name in .env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=aimeos_shop/' .env
```

### Step 4: Set Up Database

```bash
# Create database
mysql -u root -e "CREATE DATABASE IF NOT EXISTS aimeos_shop;"

# Run migrations
php artisan migrate

# Setup Aimeos with demo data
php artisan aimeos:setup --option=setup/default/demo:1
```

### Step 5: Install Frontend Assets

```bash
# Install npm packages
npm install

# Build assets
npm run build
```

### Step 6: Create Admin Account

Use Laravel tinker to create the admin user:

```bash
php artisan tinker
```

Inside tinker, run:

```php
$user = new App\Models\User();
$user->name = 'Admin User';
$user->email = 'admin@shop.com';
$user->password = bcrypt('admin123');
$user->superuser = 1;
$user->save();
exit
```

### Step 7: Create Demo Customer Account

Use Laravel tinker to create a customer account:

```bash
php artisan tinker
```

Inside tinker, run:

```php
$user = new App\Models\User();
$user->name = 'Demo Customer';
$user->email = 'customer@example.com';
$user->password = bcrypt('customer123');
$user->save();
exit
```

### Step 8: Start the Development Server

```bash
php artisan serve
```

The application will be available at: **http://127.0.0.1:8000**

## 🌐 Access the Application

### Frontend (Shop)
- **Home Page:** http://127.0.0.1:8000
- **Shop Search:** http://127.0.0.1:8000/shop/search
- **Product Catalog:** http://127.0.0.1:8000/shop

### Backend (Admin Panel)
- **Admin Dashboard:** http://127.0.0.1:8000/admin

## 🔑 Login Credentials

### Admin Account
- **Email:** admin@shop.com
- **Password:** admin123
- **Access:** Full admin panel access

### Demo Customer Account
- **Email:** customer@example.com
- **Password:** customer123
- **Access:** Shop frontend, can place orders

## ✨ Features

- ✅ Product catalog with categories
- ✅ Shopping cart and checkout
- ✅ Customer accounts and order history
- ✅ Admin panel for management
- ✅ Multiple payment methods
- ✅ Shipping options
- ✅ Coupon/voucher system
- ✅ Multi-language support
- ✅ Responsive design

## 🛠️ Common Commands

### Development

```bash
# Start development server
php artisan serve

# Watch and rebuild assets on change
npm run dev

# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear
```

### Database

```bash
# Run migrations
php artisan migrate

# Reset and re-run all migrations
php artisan migrate:fresh

# Setup Aimeos (with demo data)
php artisan aimeos:setup --option=setup/default/demo:1

# Setup Aimeos (without demo data)
php artisan aimeos:setup
```

### User Management

```bash
# Create admin account
php artisan aimeos:account --super admin@example.com

# Create editor account
php artisan aimeos:account --editor editor@example.com
```

## 📁 Project Structure

```
aimeos-shop/
├── app/
│   ├── Console/           # Artisan commands
│   ├── Exceptions/        # Exception handlers
│   ├── Http/
│   │   ├── Controllers/   # Application controllers
│   │   ├── Middleware/    # HTTP middleware
│   │   └── Kernel.php     # HTTP kernel
│   ├── Models/
│   │   └── User.php       # User model (Eloquent ORM)
│   └── Providers/         # Service providers
│
├── bootstrap/
│   ├── app.php            # Application bootstrap
│   └── cache/             # Framework cache files
│
├── config/
│   ├── app.php            # Application configuration
│   ├── database.php       # Database configuration
│   ├── shop.php           # Aimeos shop configuration
│   └── ...                # Other config files
│
├── database/
│   ├── migrations/        # Database migrations
│   ├── seeders/           # Database seeders
│   └── factories/         # Model factories
│
├── public/
│   ├── index.php          # Application entry point
│   ├── vendor/
│   │   └── shop/          # Aimeos public assets
│   └── build/             # Compiled frontend assets
│
├── resources/
│   ├── views/             # Blade templates
│   ├── css/               # CSS source files
│   └── js/                # JavaScript source files
│
├── routes/
│   ├── web.php            # Web routes
│   ├── api.php            # API routes
│   └── console.php        # Console routes
│
├── storage/
│   ├── app/               # Application storage
│   ├── framework/         # Framework files
│   └── logs/              # Application logs
│       └── laravel.log    # Main log file
│
├── tests/                 # Application tests
│   ├── Feature/           # Feature tests
│   └── Unit/              # Unit tests
│
├── vendor/                # Composer dependencies
│   ├── aimeos/            # Aimeos packages
│   │   ├── aimeos-laravel/      # Laravel integration
│   │   ├── aimeos-core/         # Core e-commerce
│   │   ├── ai-client-html/      # HTML frontend
│   │   ├── ai-admin-jqadm/      # Admin interface
│   │   └── ...                  # Other Aimeos packages
│   ├── laravel/           # Laravel framework
│   └── ...                # Other dependencies
│
├── .env                   # Environment configuration (not in git)
├── .env.example           # Example environment file
├── artisan                # Laravel CLI tool
├── composer.json          # PHP dependencies
├── composer.lock          # Locked PHP dependencies
├── package.json           # Node.js dependencies
├── package-lock.json      # Locked Node.js dependencies
├── vite.config.js         # Vite build configuration
└── README.md              # This file
```

## 🔧 What I Did After Cloning

After cloning the repository, here are all the steps I performed to make it run:

### 1. Cloned the Repository
```bash
cd /home/ract/All/School/OOP
git clone https://github.com/aimeos/aimeos.git aimeos-shop
```
- Changed to the OOP directory
- Cloned the Aimeos repository from GitHub
- Named the directory `aimeos-shop`

### 2. Changed into Project Directory
```bash
cd aimeos-shop
```
- Navigated into the newly cloned project
- All subsequent commands were run from this directory

### 3. Installed PHP Dependencies
```bash
composer install
```
This installed all Laravel and Aimeos packages defined in `composer.json`, including:
- Laravel framework (v11.x)
- Aimeos core packages (aimeos-laravel, aimeos-core, ai-client-html, ai-admin-jqadm, etc.)
- All required PHP libraries (Symfony components, Guzzle, etc.)
- Created `vendor/` directory with all dependencies

### 4. Created Environment Configuration
```bash
cp .env.example .env
```
- Copied the example environment file to `.env`
- This file contains all environment-specific settings

```bash
php artisan key:generate
```
- Generated a unique application key (APP_KEY)
- This key is used for encryption and session security

Edited the `.env` file with database configuration:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aimeos_shop
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Created MySQL Database
```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS aimeos_shop;"
```
- Connected to MySQL as root user
- Created database named `aimeos_shop`
- Used `IF NOT EXISTS` to avoid errors if database already exists

### 6. Ran Laravel Migrations
```bash
php artisan migrate
```
- Executed all migration files in `database/migrations/`
- Created base Laravel tables:
  - `users` - User accounts
  - `password_resets` - Password reset tokens
  - `failed_jobs` - Failed queue jobs
  - `personal_access_tokens` - API tokens

### 7. Set Up Aimeos with Demo Data
```bash
php artisan aimeos:setup --option=setup/default/demo:1
```
This command performed multiple operations:
- Created all Aimeos database tables (100+ tables for products, orders, customers, etc.)
- Set up table indexes and foreign keys
- Populated demo data:
  - Sample products (electronics, clothing, etc.)
  - Product categories and attributes
  - Demo customer accounts
  - Sample orders
  - Payment and shipping configurations
- Configured default settings for the shop

### 8. Installed Frontend Dependencies
```bash
npm install
```
Installed Node.js packages defined in `package.json`:
- Vite (modern build tool)
- Laravel Vite plugin
- Axios (HTTP client)
- CSS/JS processing libraries
- Created `node_modules/` directory
- Automatically updated `package-lock.json` with locked dependency versions

### 9. Built Frontend Assets
```bash
npm run build
```
- Compiled CSS files from `resources/css/`
- Compiled JavaScript files from `resources/js/`
- Optimized and minified assets for production
- Generated files in `public/build/` directory:
  - `app.css` - Compiled stylesheets
  - `app.js` - Compiled JavaScript
  - `manifest.json` - Asset manifest

### 10. Created Admin Account Using Tinker
```bash
php artisan tinker
```
- Opened Laravel's interactive shell (REPL)

Then inside tinker, ran these commands:
```php
$user = new App\Models\User();
$user->name = 'Admin User';
$user->email = 'admin@shop.com';
$user->password = bcrypt('admin123');
$user->superuser = 1;
$user->save();
exit
```
What each line does:
- `new App\Models\User()` - Created new User model instance
- `$user->name = 'Admin User'` - Set the user's name
- `$user->email = 'admin@shop.com'` - Set login email
- `$user->password = bcrypt('admin123')` - Hashed password with bcrypt
- `$user->superuser = 1` - Set superuser flag for admin access
- `$user->save()` - Saved to database (INSERT query)
- `exit` - Closed tinker shell

### 11. Created Demo Customer Account Using Tinker
```bash
php artisan tinker
```
- Opened Laravel's interactive shell again

Then inside tinker, ran these commands:
```php
$user = new App\Models\User();
$user->name = 'Demo Customer';
$user->email = 'customer@example.com';
$user->password = bcrypt('customer123');
$user->save();
exit
```
What's different:
- No `superuser` flag - regular customer account
- Can login to shop frontend
- Can browse products and place orders
- Cannot access admin panel

### 12. Started Development Server
```bash
php artisan serve
```
- Started PHP's built-in web server
- Listening on `127.0.0.1:8000`
- Server runs in foreground (Ctrl+C to stop)
- Accessible at http://127.0.0.1:8000
- Logs all HTTP requests to terminal

## 🎓 How to Use

### Browse the Shop (Frontend)
1. Go to http://127.0.0.1:8000
2. Browse products and categories
3. Add items to cart
4. Login with: customer@example.com / customer123
5. Complete a test order

### Use the Admin Panel
1. Go to http://127.0.0.1:8000/admin
2. Login with: admin@shop.com / admin123
3. Manage products, orders, and customers

### Working with Laravel

**Routing** - Define URLs in `routes/web.php`:
```php
Route::get('/custom', function () {
    return view('custom');
});
```

**Eloquent ORM** - Query database using models in `app/Models/`:
```php
// Get all users
$users = User::all();

// Find user by email
$user = User::where('email', 'admin@shop.com')->first();

// Create new user
$user = new User();
$user->name = 'John';
$user->email = 'john@example.com';
$user->password = bcrypt('password');
$user->save();
```

**Blade Templates** - Create views in `resources/views/`:
```blade
<!-- resources/views/welcome.blade.php -->
<h1>Welcome {{ $user->name }}</h1>
@foreach($products as $product)
    <p>{{ $product->name }}</p>
@endforeach
```

**Controllers** - Handle logic in `app/Http/Controllers/`:
```php
namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}
```

**Migrations** - Modify database in `database/migrations/`:
```php
Schema::create('custom_table', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

**Artisan Commands** - Use Laravel CLI:
```bash
php artisan make:controller ProductController
php artisan make:model Product -m
php artisan make:migration create_products_table
php artisan db:seed
```

### Working with Aimeos

**Configuration** - Modify `config/shop.php`:
```php
'shop' => [
    'name' => 'My Shop',
    'locale' => 'en',
    // ... other settings
]
```

**Extending Aimeos** - Add custom functionality:
- Create decorators in `app/`
- Override templates in `resources/views/vendor/shop/`
- Add custom routes in `routes/web.php`

**API Access** - Use JSON API:
```bash
# Get products
curl http://127.0.0.1:8000/jsonapi/product

# Get specific product
curl http://127.0.0.1:8000/jsonapi/product/1
```

## 🔄 Creating Additional Accounts

### Create Another Admin

```bash
cd aimeos-shop
php artisan tinker
```

Inside tinker:
```php
$user = new App\Models\User();
$user->name = 'New Admin';
$user->email = 'newadmin@shop.com';
$user->password = bcrypt('password123');
$user->superuser = 1;
$user->save();
exit
```

### Create Another Customer

```bash
cd aimeos-shop
php artisan tinker
```

Inside tinker:
```php
$user = new App\Models\User();
$user->name = 'John Doe';
$user->email = 'john@example.com';
$user->password = bcrypt('password123');
$user->save();
exit
```

## 🐛 Troubleshooting

### Database Connection Error

1. Make sure MySQL is running:
   ```bash
   sudo systemctl status mysql
   ```

2. Verify database credentials in `.env` file

3. Test database connection:
   ```bash
   mysql -u root -p
   ```

### Permission Errors

```bash
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

### Port Already in Use

```bash
# Use a different port
php artisan serve --port=8080
```

### Clear All Caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Reset Database

```bash
# Warning: This deletes all data
php artisan migrate:fresh
php artisan aimeos:setup --option=setup/default/demo:1
```

## 📚 Learning Resources

- [Aimeos Documentation](https://aimeos.org/docs/)
- [Laravel Documentation](https://laravel.com/docs)
- [Aimeos Forum](https://aimeos.org/help/)
- [GitHub Repository](https://github.com/aimeos/aimeos)

## 🔐 Security Notes

**For Production:**

1. Change all default passwords
2. Set `APP_DEBUG=false` in `.env`
3. Set `APP_ENV=production` in `.env`
4. Use strong database passwords
5. Enable HTTPS
6. Set proper file permissions
7. Never commit `.env` file to version control

## 📝 Notes

- This is a **development setup** - not for production
- Demo data includes sample products and categories
- SQLite is **NOT supported** - use MySQL/MariaDB
- Default passwords should be changed for production

## 🔄 How to Use This Repository

### For Fresh Setup (First Time)

1. **Clone the repository**
   ```bash
   cd /home/ract/All/School/OOP
   git clone https://github.com/aimeos/aimeos.git aimeos-shop
   cd aimeos-shop
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   Edit `.env` with your database credentials:
   ```env
   DB_DATABASE=aimeos_shop
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Set up database**
   ```bash
   mysql -u root -e "CREATE DATABASE aimeos_shop;"
   php artisan migrate
   php artisan aimeos:setup --option=setup/default/demo:1
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Create accounts using tinker**
   ```bash
   php artisan tinker
   ```
   
   Admin account:
   ```php
   $user = new App\Models\User();
   $user->name = 'Admin User';
   $user->email = 'admin@shop.com';
   $user->password = bcrypt('admin123');
   $user->superuser = 1;
   $user->save();
   exit
   ```
   
   Customer account:
   ```bash
   php artisan tinker
   ```
   ```php
   $user = new App\Models\User();
   $user->name = 'Demo Customer';
   $user->email = 'customer@example.com';
   $user->password = bcrypt('customer123');
   $user->save();
   exit
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```
   
   Visit: http://127.0.0.1:8000

### For Existing Setup (Already Cloned)

1. **Navigate to project**
   ```bash
   cd /home/ract/All/School/OOP/aimeos-shop
   ```

2. **Start the server**
   ```bash
   php artisan serve
   ```

3. **Access the application**
   - Shop: http://127.0.0.1:8000
   - Admin: http://127.0.0.1:8000/admin

### Daily Development Workflow

1. **Start server**
   ```bash
   cd aimeos-shop
   php artisan serve
   ```

2. **Make changes to code**
   - Edit files in `app/`, `resources/`, `routes/`, etc.

3. **If you modify frontend assets**
   ```bash
   npm run dev    # Watch for changes
   # or
   npm run build  # Build for production
   ```

4. **If you modify database**
   ```bash
   php artisan migrate              # Run new migrations
   php artisan migrate:fresh        # Reset database
   php artisan aimeos:setup         # Re-setup Aimeos
   ```

5. **Clear caches when needed**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

### Common Tasks

**Add a new product (via Admin Panel)**
1. Go to http://127.0.0.1:8000/admin
2. Login with admin@shop.com / admin123
3. Navigate to Products → Add Product

**Test customer checkout**
1. Go to http://127.0.0.1:8000
2. Login with customer@example.com / customer123
3. Add products to cart
4. Proceed to checkout

**Create new user via tinker**
```bash
php artisan tinker
```
```php
$user = new App\Models\User();
$user->name = 'New User';
$user->email = 'user@example.com';
$user->password = bcrypt('password');
$user->save();
exit
```

**View logs**
```bash
tail -f storage/logs/laravel.log
```

**Access database**
```bash
mysql -u root aimeos_shop
```

### Stopping the Server

Press `Ctrl + C` in the terminal where the server is running

---

**Created:** October 2025  
**Version:** 2025.10  
**License:** MIT
