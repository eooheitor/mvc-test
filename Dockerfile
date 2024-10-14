FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    curl \
    unzip

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

COPY ./ /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite

RUN sed -i -e 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html

CMD ["apache2-foreground"]
