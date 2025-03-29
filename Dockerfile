FROM php:8.2-apache
# Install MySQL extension
RUN docker-php-ext-install mysqli
# Enable the extension
RUN docker-php-ext-enable mysqli
WORKDIR /var/www/html
COPY *.php .
