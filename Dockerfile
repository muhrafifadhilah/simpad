# Stage 1: Build the Vite app
FROM node:20 AS vite-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install --legacy-peer-deps
COPY . .
RUN npm run build
# Debug: list public folder contents, but do not fail if dist/build doesn't exist
RUN ls -la /app/public/ || true

# Stage 2: Setup PHP and Laravel
FROM composer:2 AS composer
WORKDIR /app
COPY . .  
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stage 3: Setup the final image
FROM php:8.2-fpm
WORKDIR /var/www/
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    nginx \
    libpq-dev
# Install pdo_mysql extension for MySQL connection
RUN docker-php-ext-install pdo_mysql

# Copy Vite build output
COPY --from=vite-builder /app/public/build /var/www/public/build

# Copy Composer dependencies
COPY --from=composer /app/ /var/www/

# Change owner to www-data for Laravel storage
RUN chown -R www-data:www-data /var/www/storage

# Copy Nginx default configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm