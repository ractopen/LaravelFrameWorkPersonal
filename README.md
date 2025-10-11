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
| `task-*` | Individual tasks (e.g., `task-1-authentication`, `task-2-crud`) |

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

<p align="center">Laravel learning repository</p>
