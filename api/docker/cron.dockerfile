FROM php:8.1-apache

RUN apt-get update

RUN apt-get install -y \
    pkg-config  \
    libzip-dev \
    cron \
    nano

RUN docker-php-ext-install \
    mysqli \
    pdo_mysql \
    zip

RUN echo "* * * * * root cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab
RUN crontab /etc/crontab

ENTRYPOINT ["cron", "-f"]
