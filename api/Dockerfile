FROM php:8-apache
# RUN a2enmod rewrite
# RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite \
    && apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql intl
