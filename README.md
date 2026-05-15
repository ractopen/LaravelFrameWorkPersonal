<div align="center">

<img width="100%" src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=180&section=header&text=Laravel%20Personal%20🚀&fontSize=42&fontAlignY=32&desc=School%20Activity%20|%20Learning%20Full-Stack%20Development&descAlignY=51&descAlign=50&animation=twinkling"/>

[![Typing SVG](https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&color=00D4FF&center=true&vCenter=true&width=435&lines=Laravel+Framework;PostgreSQL+Database;Branch-per-Task+Workflow;OOP+School+Tasks)](https://git.io/typing-svg)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-336791?style=for-the-badge&logo=postgresql&logoColor=white)

</div>

---

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
