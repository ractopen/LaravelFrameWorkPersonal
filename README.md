<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php">
<img src="https://img.shields.io/badge/Database-PostgreSQL-336791?style=for-the-badge&logo=postgresql">
</p>

<p align="center">
  <a href="#repository-structure">🏗️ Repository</a> •
  <a href="#setup-instructions">⚙️ Setup</a> •
  <a href="#what-i-did">📝 What I Did</a> •
  <a href="#tech-stack">🛠️ Tech Stack</a>
</p>

# Laravel Framework Personal

A Laravel learning repository for OOP school tasks. Use the `main` branch as the base for copying and creating new task branches.

## Repository Structure

This project uses a branch-per-task workflow for learning Laravel concepts.

### Branch Organization

| Branch | Purpose |
|--------|---------|
| [`main`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/main) | Base Laravel template for copying and creating new tasks |
| [`task2-routing`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task2-routing) | Task 2: Routing in Laravel |
| [`task3-connectToPGSQL`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task3-connectToPGSQL) | Task 3: Connect to PostgreSQL and implement authentication |
| [`task4-models-eloquent`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task4-models-eloquent) | Task 4: Models and Eloquent Relationships |

### Workflow

```bash
# Copy the main branch for a new task
git clone https://github.com/ractopen/LaravelFrameWorkPersonal.git
cd LaravelFrameWorkPersonal

# Create a new branch for your task
git checkout -b task-your-task-name

# Work on the task
# ...

# Commit and push
git add .
git commit -m "Complete task: your description"
git push -u origin task-your-task-name
```

## Setup Instructions

### Quick Setup

```bash
# Navigate to project directory
cd LaravelFrameWorkPersonal

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup PostgreSQL database (make sure PostgreSQL is running)
php artisan migrate

# Start server
php artisan serve
```

## What I Did <a name="what-i-did"></a>

Created the base Laravel project using:
```bash
composer create-project laravel/laravel LaravelFrameWorkPersonal
```

This is the base Laravel template. No specific implementation here; use this as the starting point for your tasks.
```

## Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Database:** PostgreSQL
- **Frontend:** Blade Templates
- **Version Control:** Git & GitHub

---

<p align="center">Laravel learning repository</p>
