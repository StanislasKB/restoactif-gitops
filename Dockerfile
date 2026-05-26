# Stage 1: Composer dependencies
FROM php:8.3-cli-alpine AS vendor
WORKDIR /app

RUN apk add --no-cache git unzip libzip-dev \
    && docker-php-ext-install zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .
RUN composer install \
    --no-dev \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist \
    --ignore-platform-req=ext-*

# Stage 2: PHP runtime
FROM php:8.3-fpm-alpine
WORKDIR /var/www/html

RUN apk add --no-cache nginx supervisor postgresql-dev mysql-client \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql bcmath opcache

COPY . .
COPY --from=vendor /app/vendor ./vendor

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]