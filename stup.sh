#!/bin/bash

set +e  # Don't exit on errors
echo "🚀 Laravel Models Eloquent Auto Setup"

# Checkout to task3 branch
echo "git checkout task3-connectToPGSQL"
git checkout task3-connectToPGSQL

# Install Composer dependencies
echo "composer install"
composer install

# Copy .env.example to .env if .env doesn't exist
echo "cp .env.example .env || copying .env"
cp .env.example .env

# Generate application key
echo "php artisan key:generate"
php artisan key:generate

echo "edit .env and setup database then run php artisan migrate and php artisan serve"
