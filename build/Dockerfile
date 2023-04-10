FROM yiisoftware/yii2-php:8.0-apache

WORKDIR /app

COPY ./ /app

RUN #apt-get install supervisord


RUN chown -R www-data:www-data /app \
    && a2enmod rewrite \
    && a2enmod rewrite headers \
    && chmod -R 775 /app

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf

RUN sed -i -e 's|DocumentRoot /app/backend/web|DocumentRoot /app/backend/web \r\nDirectoryIndex index.php|g' /etc/apache2/sites-available/000-default.conf

RUN composer install

COPY build/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint
RUN chmod 755 /usr/local/bin/docker-php-entrypoint