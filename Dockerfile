FROM php:8.2-cli

# Minimal image to run the app with php artisan serve
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_sqlite mbstring exif bcmath gd || true

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy application
COPY . /var/www

# Install PHP deps (production-ready; adjust flags if you want dev deps)
RUN composer install --no-interaction --optimize-autoloader --no-dev || true

# Ensure SQLite file exists for default setup
RUN mkdir -p database && touch database/database.sqlite || true

# Expose artisan serve port
EXPOSE 8000

# Default command: run the built-in PHP server for quick demos
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
