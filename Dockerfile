FROM php:7.2-apache
COPY /src /var/www/html
WORKDIR /var/www/html
EXPOSE 80
CMD docker run -it --rm --volume $PWD/src:/app composer install