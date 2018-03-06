FROM php:7.2-apache
COPY src/ /var/www/html/
#COPY config/php.ini /usr/local/etc/php/
WORKDIR app/
