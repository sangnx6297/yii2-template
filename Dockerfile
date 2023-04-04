FROM yiisoftware/yii2-php:8.0-apache

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf

RUN sed -i -e 's|DocumentRoot /app/backend/web|DocumentRoot /app/backend/web \r\nDirectoryIndex index.php|g' /etc/apache2/sites-available/000-default.conf

