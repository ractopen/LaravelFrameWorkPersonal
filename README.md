<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-v12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
<img src="https://img.shields.io/badge/Status-Learning-green?style=for-the-badge" alt="Status">
</p>

# 🎓 Laravel Framework Personal

> A Laravel learning repository for my OOP course - tracking my journey from beginner to proficient.

## 📚 About This Repository

This repository documents my progress through Laravel assignments and exercises as a **2nd year Computer Science student**. Each branch represents a specific task or concept I've learned, making it easy to review my growth throughout the course.

## 🌳 Repository Structure

This project uses a **branch-per-task workflow** to keep each assignment isolated and organized.

### Branch Organization

| Branch | Purpose |
|--------|---------|
| `main` | 🏠 Base Laravel installation (clean slate) |
| `development` | 🚧 Active development and experimentation |
| `task-*` | 📝 Individual assignments (e.g., `task-1-authentication`, `task-2-crud`) |

### 🔄 My Workflow

```bash
# 1. Create a new branch for each task
git checkout -b task-name

# 2. Complete the assignment
# ... code, code, code ...

# 3. Commit and push
git add .
git commit -m "Complete task: description"
git push -u origin task-name

# 4. Switch back to development for next task
git checkout development
```

This approach lets me:
- ✅ Keep each task isolated and clean
- ✅ Easily review past work
- ✅ Track my learning progression
- ✅ Showcase specific skills per branch

## 🚀 Setup Instructions

Want to run this project on another device? Follow these steps:

```bash
# Clone the repository
git clone https://github.com/ractopen/LaravelFrameWorkPersonal.git
cd LaravelFrameWorkPersonal

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Setup environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Setup SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Start the development server
php artisan serve
```

Visit `http://localhost:8000` in your browser! 🎉

## 📖 Course Information

- **Course:** Object-Oriented Programming (OOP)
- **Institution:** Computer Science Program
- **Year:** 2nd Year
- **Framework:** Laravel 12.x
- **Purpose:** Hands-on learning and skill development

## 🛠️ Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Database:** SQLite (Development)
- **Frontend:** Blade Templates, Vite
- **Version Control:** Git & GitHub

## 📝 Learning Goals

Throughout this course, I'm working on:
- 🎯 Understanding MVC architecture
- 🎯 Building RESTful APIs
- 🎯 Database design and migrations
- 🎯 Authentication and authorization
- 🎯 CRUD operations
- 🎯 Laravel best practices

## 📫 Contact

Feel free to explore the branches to see my progress on different tasks!

---

<p align="center">Made with ❤️ by a CS student learning Laravel</p>
