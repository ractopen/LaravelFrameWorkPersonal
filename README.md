# Laravel Framework Personal

A Laravel learning repository for OOP school tasks. Use the `main` branch as the base for copying and creating new task branches.

## Repository Structure

This project uses a branch-per-task workflow for learning Laravel concepts.

### Branch Organization

| Branch | Purpose |
|--------|---------|
| [`main`](https://github.com/ractopen/LaravelFrameWorkPersonal/tree/main) | Base Laravel template for copying and creating new tasks |

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

```bash
# Install dependencies
composer install
npm install  # Optional: for frontend assets (Vite, etc.)

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
