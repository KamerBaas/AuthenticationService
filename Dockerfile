FROM php:7.2-apache
COPY src/ /var/www
#RUN chmod +x /var/www/storage
#RUN chmod +x /var/www/bootstrap/cache
COPY src/public /var/www/html

#RUN mv /var/www /var/www &&\
#    find /var/www/storage/ -type d -exec chmod 755 {} \; &&\
#    find /var/www/bootstrap/cache -type f -exec chmod 755 {} \;

# Give writing permission for larvel sessions


# If you want to add custom php.ini
#COPY config/php.ini /usr/local/etc/php/
WORKDIR /var/www
RUN chgrp -R www-data storage bootstrap/cache
RUN chmod -R ug+rwx storage bootstrap/cache
