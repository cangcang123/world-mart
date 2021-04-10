FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    telnet \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip && \
    pecl install mongodb && docker-php-ext-enable mongodb

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# RUN /usr/bin/composer install --prefer-dist --no-dev --no-ansi --no-interaction --no-progress --no-scripts --no-autoloader
# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
# RUN chown -R $user:$user /var/www
WORKDIR /var/www
COPY --chown=$user:$user . .
RUN chown -R $user:$user /var/www \
    && chmod 777 -R bootstrap/cache \
    && chmod 777 -R storage/app \
    && chmod 777 -R storage/framework \
    && chmod 777 -R storage/logs
# RUN rm -rf ./vendor
RUN mkdir -p /var/www/vendor && chown -R $user:$user /var/www/vendor
# RUN ls /var/www/database
USER $user
RUN ls
# RUN /usr/bin/composer update --no-scripts
# RUN /usr/bin/composer install --prefer-dist --no-dev --no-ansi --no-interaction --no-progress --no-scripts --no-autoloader
RUN /usr/bin/composer install
# RUN php artisan key:generate -y
RUN /usr/bin/composer update
RUN /usr/bin/composer dump-autoload --optimize
RUN php artisan event:cache
RUN php artisan storage:link
# RUN php artisan admin:reset-pass
# RUN php artisan serve
# RUN php artisan serve --host=0.0.0.0 --port=8000