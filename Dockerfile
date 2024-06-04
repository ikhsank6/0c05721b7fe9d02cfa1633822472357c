# Use the official PHP image with Apache
FROM php:8.3-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    supervisor \
    nano \
    git \
    librabbitmq-dev && pecl install amqp \
    && docker-php-ext-install pdo pdo_pgsql sockets \
    && docker-php-ext-enable amqp

# Configure supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Enable Apache modules
# RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the application code
COPY . .

# COPY .env.example /var/www/html/.env

# Expose the port the app runs on
# EXPOSE 8000

# Let supervisord start nginx & php-fpm
# CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]

