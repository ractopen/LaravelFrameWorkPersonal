<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-v12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
<img src="https://img.shields.io/badge/Database-PostgreSQL-336791?style=for-the-badge&logo=postgresql" alt="PostgreSQL Database">
</p>

<p align="center">
  <a href="#repository-structure">🏗️ Repository</a> •
  <a href="#setup-instructions">⚙️ Setup</a> •
  <a href="#what-i-did">📝 What I Did</a> •
  <a href="#tech-stack">🛠️ Tech Stack</a>
</p>

# Laravel Routing

Laravel project demonstrating routing concepts.

## Repository Structure

This project uses a branch-per-task workflow.

### Branch Organization

| Branch | Purpose |
|--------|---------|
| [`main`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/main) | Base Laravel template for copying |
| [`task2-routing`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task2-routing) | Task 2: Routing in Laravel |
| [`task3-connectToPGSQL`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task3-connectToPGSQL) | Task 3: Connect to PostgreSQL and implement authentication |
| [`task4-models-eloquent`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task4-models-eloquent) | Task 4: Models and Eloquent Relationships |

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

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database (adjust based on your database choice)
touch database/database.sqlite  # For SQLite
php artisan migrate

# Start server
php artisan serve
```

## What I Did <a name="what-i-did"></a>

Implemented routing in Laravel with separate controllers and a shared layout:

- **Controllers:** Created `HomeController`, `AboutController`, and `ContactController`, each with an `index()` method returning their respective views.
- **Routes:** Defined routes using controllers: `Route::get('/', [HomeController::class, 'index'])`, etc.
- **Layout:** Created `resources/views/layout/app.blade.php` with a header (navbar with links to home, about, contact), body (`@yield('content')`), and footer.
- **Views:** Created `home.blade.php`, `about.blade.php`, and `contact.blade.php` extending the layout with unique content.

This demonstrates organized routing with controllers and a shared layout in Laravel for better structure.

## Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Database:** Configurable (SQLite, MySQL, PostgreSQL, etc.)
- **Frontend:** Blade Templates, Vite
- **Version Control:** Git & GitHub

---

<p align="center">Laravel learning repository</p>
