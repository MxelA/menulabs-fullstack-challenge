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

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN service apache2 restart

RUN echo "* * * * * root cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab
RUN crontab /etc/crontab
ENTRYPOINT ["cron", "-f"]
#CMD ['/usr/sbin/service cron restart']
# Create the log file to be able to run tail
#RUN touch /var/log/cron.log
