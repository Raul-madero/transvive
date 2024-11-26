FROM php:7.4-fpm

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql

# Copiar archivos del proyecto
COPY . /var/www/html

# Exponer puerto
EXPOSE 9000

# Comando para iniciar el servidor web
CMD ["php-fpm"]