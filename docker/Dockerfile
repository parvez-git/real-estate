FROM php:7.4-apache As builder
COPY ./ /app/
WORKDIR /app
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git unzip zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
ENTRYPOINT [ "./startMigrationAndServer.sh" ]