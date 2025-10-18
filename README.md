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

# Laravel PostgreSQL Connection

Laravel project demonstrating connection to PostgreSQL database.

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
cp .env.example .env
php artisan key:generate

# Setup PostgreSQL database (make sure PostgreSQL is running)
php artisan migrate

# Start server
php artisan serve
```

### Automated Setup

For automated installation with PostgreSQL, run the setup script:

```bash
chmod +x stup.sh
./stup.sh
## Features <a name="features"></a>

- **Database Integration:** Seamless connection to PostgreSQL for data storage and retrieval.
- **User Authentication:** Basic login and registration system using Laravel's built-in features.
- **Responsive Design:** Mobile-friendly interface for better user experience.

## Login Flow <a name="login-flow"></a>

1. **User Registration:** Users can sign up with email and password.
2. **Email Verification:** Optional email confirmation for account activation.
3. **Login Process:** Authenticate using credentials.
4. **Session Management:** Secure session handling with remember me option.
5. **Password Reset:** Forgot password functionality via email.

## Branch: `task3-connectToPGSQL` - Simple Login/Register with PostgreSQL

![Demo GIF](assets/e.GIF)

### Overview
Basic authentication system with **username and password only**, connected to PostgreSQL via pgAdmin.

## What I Did <a name="what-i-did"></a>

### Database Setup
- Configured Laravel to connect to PostgreSQL database
- Updated `.env.example` with PostgreSQL settings
- Ensured migrations run successfully with `php artisan migrate`

### Additional Commands Used
```bash
# Test database connection
php artisan migrate:status

# Run migrations
php artisan migrate
```

## Tech Stack <a name="tech-stack"></a>

- **Backend:** Laravel (PHP Framework)
- **Database:** PostgreSQL
- **Frontend:** Blade Templates
- **Version Control:** Git & GitHub

<p align="center">Laravel Models Eloquent Demo</p>
