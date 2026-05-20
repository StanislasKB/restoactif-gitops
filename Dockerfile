# Stage 1: Composer dependencies
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Stage 2: Node assets 
# FROM node:20-alpine AS frontend
# WORKDIR /app
# COPY package.json package-lock.json ./
# RUN npm ci
# COPY . .
# RUN npm run build

# Stage 3: PHP runtime
FROM php:8.3-fpm-alpine
WORKDIR /var/www/html

RUN apk add --no-cache nginx supervisor postgresql-dev mysql-client \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql bcmath opcache

COPY . .
COPY --from=vendor /app/vendor ./vendor
# COPY --from=frontend /app/public/build ./public/build

RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]