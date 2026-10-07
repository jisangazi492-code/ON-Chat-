FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY social_media/ /var/www/html/

# Render web services commonly use port 10000.
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:10000>/g' /etc/apache2/sites-available/000-default.conf \
    && printf '%s\n' \
       '<Directory /var/www/html/>' \
       '    AllowOverride All' \
       '    Require all granted' \
       '</Directory>' \
       > /etc/apache2/conf-available/social-media.conf \
    && a2enconf social-media

# The application needs to write uploaded files at runtime.
RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/uploads

EXPOSE 10000

CMD ["apache2-foreground"]
