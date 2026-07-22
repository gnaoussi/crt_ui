FROM php:8.2-cli

# Install system dependencies & SQLite PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Create database file
RUN mkdir -p database && touch database/database.sqlite && chmod -R 777 database/

EXPOSE 8000

CMD ["sh", "-c", "composer install --no-interaction --no-security-blocking && php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=8000"]
