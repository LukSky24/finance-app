FROM php:8.2-fpm

ARG PUID=1000
ARG PGID=1000

# System deps
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libicu-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql intl zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Create non-root user matching host UID/GID to avoid permission issues
RUN groupadd -g ${PGID} appgroup \
    && useradd -u ${PUID} -g appgroup -m appuser

WORKDIR /var/www/html

# Tweak PHP
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/app.ini

# Make sure var directories exist and are writable at runtime
RUN mkdir -p var && chown -R appuser:appgroup var

USER appuser

CMD ["php-fpm"]