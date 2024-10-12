
FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY ./ /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite

RUN sed -i -e 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html

CMD ["apache2-foreground"]
