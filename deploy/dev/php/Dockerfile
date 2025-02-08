FROM php:8.2.11-fpm

RUN echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/uploads.ini

RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN apt-get update

RUN apt-get -y install apt-utils nano wget dialog vim

RUN apt-get update && apt-get install -y \
    git \
    unzip

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql