FROM php:7.4-fpm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli

# Copy project files
COPY . /sistema

# Expose port
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
