FROM php:7.4-fpm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli

# Copy project files
COPY . /var/www/html

# Establece los permisos adecuados para los archivos
RUN chown -R www-data:www-data /var/www/html

RUN apt-get update && apt-get install -y \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- \
    && mv composer.phar /usr/local/bin/composer

# Instala Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Copia configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Copia el script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# RUN composer install

# Expone los puertos necesarios
EXPOSE 80

# Usa el script para iniciar ambos procesos
CMD ["/start.sh"]

# Inicia Nginx y PHP-FPM
ENTRYPOINT service nginx start && php-fpm

