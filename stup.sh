#!/bin/bash

# Laravel Setup Script
# This script automates the basic setup for a Laravel project

set -e  # Exit on any error

echo "Starting Laravel setup..."

# Check if Composer is installed
if ! command -v composer &> /dev/null; then
    echo "Composer is not installed. Please install Composer first."
    exit 1
fi

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install

# Copy .env.example to .env if .env doesn't exist
if [ ! -f .env ]; then
    echo "Copying .env.example to .env..."
    cp .env.example .env
fi

# Generate application key
echo "Generating application key..."
php artisan key:generate

# Optional: Run migrations (uncomment if needed)
# echo "Running migrations..."
# php artisan migrate

# Optional: Install Node.js dependencies if package.json exists (uncomment if needed)
# if [ -f package.json ]; then
#     echo "Installing Node.js dependencies..."
#     npm install
# fi

echo "Laravel setup completed successfully!"
