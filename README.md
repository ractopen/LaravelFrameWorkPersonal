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

# Laravel Models Eloquent

Laravel Models and Eloquent Relationships demonstration with PostgreSQL database.

## Repository Structure <a name="repository-structure"></a>

This project uses a branch-per-task workflow.

### Branch Organization

| Branch | Purpose |
|--------|---------|
| [`main`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/main) | Base Laravel template for copying |
| [`task2-routing`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task2-routing) | Task: Routing in Laravel |
| [`task3-connectToPGSQL`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task3-connectToPGSQL) | Task: Connect to PostgreSQL |
| [`task4-models-eloquent`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/task4-models-eloquent) | Task: Models and Eloquent |

Use the `main` branch as the base for copying and creating new task branches like `task1-task-name`, `task2-task-name`, etc. for each new task.

### Workflow

```bash
# Create a new branch for each task
git checkout -b task1-task-name

# Work on the task
# ...

# Commit and push
git add .
git commit -m "Complete task1: description"
git push -u origin task1-task-name
```

## Setup Instructions <a name="setup-instructions"></a>

### Quick Setup

```bash
# Navigate to project directory
cd LaravelFrameWorkPersonal

# Install dependencies
composer install

# Setup environment
cp .env.example .env || or remove .example (the file name) 

# Regeerate key
php artisan key:generate

# Setup PostgreSQL database (make sure PostgreSQL is running) edit .env first
php artisan migrate

# Start server
php artisan serve
```

### Automated Setup

For automated installation with PostgreSQL, run the setup script:

```bash
chmod +x stup.sh
./stup.sh
```

## What I Did <a name="what-i-did"></a>

### Models Creation
```bash
# Create Dojo model with migration
php artisan make:model Dojo -mfs

# Create Ninja model with migration
php artisan make:model Ninja -mfs
```

### Eloquent Relationships
- **Dojo Model**: Added `ninjas()` relationship (One-to-Many)
- **Ninja Model**: Added `dojo()` relationship (Many-to-One)
- **Database**: Created foreign key constraints in migrations

### Additional Commands Used
```bash
# Create controllers
php artisan make:controller DojoController
php artisan make:controller NinjaController

# Create views
dojo.index, ninja.index views created
```

## How to Use <a name="how-to-use"></a>

### Using Laravel Tinker
Laravel Tinker allows you to interact with your application in real-time. Here's how to use it:

```bash
# Start Tinker
php artisan tinker
```

#### Examples
- **Create a new Dojo**:
  ```php
  $dojo = App\Models\Dojo::create([
      'name' => 'test dojo',
      'description' => 'elo'
  ]);
  ```

- **Create a new Ninja**:
  ```php
  $ninja = App\Models\Ninja::create([
      'name' => 'test ninja',
      'level' => 5,
      'bio' => 'a skilled warrior',
      'dojo_id' => 1
  ]);
  ```

- **Query Ninjas in a Dojo**:
  ```php
  $dojo = App\Models\Dojo::find(1);
  $ninjas = $dojo->ninjas;
  ```

Use `exit` or Ctrl+D to quit Tinker.

## Tech Stack <a name="tech-stack"></a>

- **Backend:** Laravel (PHP Framework)
- **Database:** PostgreSQL
- **Frontend:** Blade Templates
- **Version Control:** Git & GitHub

<p align="center">Laravel Models Eloquent Demo</p>
