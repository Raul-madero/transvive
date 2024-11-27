#!/bin/bash

# Inicia PHP-FPM
php-fpm &

# Inicia Nginx
nginx -g "daemon off;"
