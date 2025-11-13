FROM wordpress:6.4-php8.2-fpm

# Install additional PHP extensions and tools
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    wget \
    curl \
    git \
    vim \
    && docker-php-ext-install zip \
    && docker-php-ext-enable zip

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/wp-cli/v2.9.0/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Configure PHP for WordPress optimization
RUN { \
    echo 'memory_limit = 512M'; \
    echo 'upload_max_filesize = 64M'; \
    echo 'post_max_size = 64M'; \
    echo 'max_execution_time = 300'; \
    echo 'max_input_vars = 3000'; \
    echo 'opcache.enable = 1'; \
    echo 'opcache.memory_consumption = 128'; \
    echo 'opcache.interned_strings_buffer = 8'; \
    echo 'opcache.max_accelerated_files = 4000'; \
    echo 'opcache.revalidate_freq = 2'; \
    echo 'opcache.fast_shutdown = 1'; \
} > /usr/local/etc/php/conf.d/wordpress.ini

# Create WordPress user for security
RUN groupadd -r wordpress && useradd -r -g wordpress wordpress

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose PHP-FPM port
EXPOSE 9000

# Set working directory
WORKDIR /var/www/html

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=60s --retries=3 \
    CMD php-fpm-healthcheck || exit 1

# Install php-fpm-healthcheck
RUN wget -O /usr/local/bin/php-fpm-healthcheck \
    https://raw.githubusercontent.com/renatomefi/php-fpm-healthcheck/master/php-fpm-healthcheck \
    && chmod +x /usr/local/bin/php-fpm-healthcheck