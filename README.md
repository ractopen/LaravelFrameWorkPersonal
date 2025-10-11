<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-v12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
</p>

# Laravel Framework Personal

A Laravel learning repository. Each branch represents a different task or exercise.

## Repository Structure

This project uses a branch-per-task workflow.

### Branch Organization

| Branch | Purpose |
|--------|---------|
| `main` | Base Laravel template for copying |
| `task-connectToPGSQL` | Task 2: Connect a simple login/signup to PostgreSQL |

### Workflow

```bash
# Create a new branch for each task
git checkout -b task-name

# Work on the task
# ...

# Commit and push
git add .
git commit -m "Complete task: description"
git push -u origin task-name
```

## Setup Instructions

```bash
# Clone the repository
git clone https://github.com/ractopen/LaravelFrameWorkPersonal.git
cd LaravelFrameWorkPersonal

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database (adjust based on your database choice)
touch database/database.sqlite  # For SQLite
php artisan migrate

# Start server
php artisan serve
```

## Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Database:** Configurable (SQLite, MySQL, PostgreSQL, etc.)
- **Frontend:** Blade Templates, Vite
- **Version Control:** Git & GitHub

---

## Branch: `task-connectToPGSQL` - Simple Login/Register with PostgreSQL

### Overview
Basic authentication system with **username and password only**, connected to PostgreSQL via pgAdmin.

**Sessions stored in database** - You can see active logins in pgAdmin!

#### 🔹 Register Button Flow
```
User fills form → Clicks "Register" →
1. POST /register
2. Check if username exists in PostgreSQL
3. If exists → Error: "User already exists"
4. If new → Save plain text password to database
5. Redirect to /login

SESSION CREATION:
├─ Generate random session ID (e.g., "abc123xyz...")
├─ Store in sessions table: user_id, username, IP, browser info
├─ Send session ID to browser as cookie
└─ User stays logged in on all pages
```

#### 🔹 Login Button Flow
```
User fills form → Clicks "Login" →
1. POST /login
2. Search PostgreSQL for username
3. If not found → Show error "Invalid credentials"
4. If found → Compare plain text password
5. If wrong → Show error "Invalid credentials"
6. If correct → Create session in database → Redirect to / (welcome)

SESSION CREATION:
├─ Generate random session ID (e.g., "abc123xyz...")
├─ Store in sessions table: user_id, username, IP, browser info
├─ Send session ID to browser as cookie
└─ User stays logged in on all pages
```

#### 🔹 Logout Button Flow
```
User clicks "Logout" →
1. POST /logout
2. Delete session from database (removes row from sessions table)
3. Clear browser cookie
4. Redirect to /login
```

### How Database Sessions Work

**Visual Flow:**
```
LOGIN:
Browser → Sends email/password → Laravel
Laravel → Checks PostgreSQL users table → Valid!
Laravel → Creates session row in sessions table
Laravel → Sends session ID cookie → Browser
Browser → Stores cookie

NEXT PAGE VISIT:
Browser → Sends cookie with session ID → Laravel
Laravel → Looks up session ID in sessions table
Laravel → Finds user_id → User is logged in!
Laravel → Shows protected content

LOGOUT:
Browser → Clicks logout → Laravel
Laravel → Deletes row from sessions table
Laravel → Clears cookie → Browser
Browser → No longer logged in
```

**What's in the sessions table:**
```
id          | user_id | ip_address  | user_agent           | payload        | last_activity
------------|---------|-------------|----------------------|----------------|---------------
abc123xyz   | 1       | 127.0.0.1   | Chrome/Windows       | {user data}    | 1728619200
def456uvw   | 2       | 192.168.1.5 | Firefox/Mac          | {user data}    | 1728619150
```

**Benefits of Database Sessions:**
- ✅ View all logged-in users in pgAdmin
- ✅ See when they were last active
- ✅ See their IP addresses and browsers
- ✅ Manually delete sessions to force logout
- ✅ Track user activity

### Setup Instructions

**1. Configure Laravel .env**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=connectToDatabasePGSQL
DB_USERNAME=postgres
DB_PASSWORD=your_password_here
```

**2. Run Migration**
```bash
php artisan migrate  # Creates users table in PostgreSQL
```

**3. Start Server**
```bash
php artisan serve
# Visit: http://localhost:8000
```

### Files Created/Modified

- `resources/views/register.blade.php` - Registration form (username + password)
- `resources/views/login.blade.php` - Login form (username + password)
- `resources/views/welcome.blade.php` - Dashboard after login
- `routes/web.php` - Routes with detailed comments
- `database/migrations/0001_01_01_000000_create_users_table.php` - Simple users table
- `.env.example` - PostgreSQL configuration

### Key Features

✅ Username uniqueness check (prevents duplicate users)  
✅ Plain text password storage (easy to view in database)  
✅ Clear flow explanations with keypoints in all files  

---

<p align="center">Laravel learning repository</p>
