FROM php:7.3-apache

# Copy VHost-Configuration into Container
COPY docker-config/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# create ssl files in image
RUN mkdir /etc/apache2/ssl
RUN openssl req -new -newkey rsa:4096 -days 365 -nodes -x509 -subj \
"/C=DE/ST=NRW/L=Dev/O=LionDeer/CN=localhost" \
-keyout /etc/apache2/ssl/ssl.key -out /etc/apache2/ssl/ssl.crt

ENV XDEBUG_CONFIG="idekey=PHPSTORM"
ENV PHP_IDE_CONFIG="serverName=firststeps"

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update
RUN apt-get install -y \
        libzip-dev \
        zip \
        libicu-dev \
        libpng-dev \
        libldap2-dev \
        zlib1g-dev \
        yarn \
        git \
        gnupg2

RUN rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install zip
RUN docker-php-ext-install json
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install intl
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install ctype
RUN docker-php-ext-install iconv

# Install X-Debug
RUN pecl install xdebug

# Enable OPCache
RUN docker-php-ext-install opcache

RUN docker-php-ext-enable xdebug

# Enable ModRwrite
RUN a2enmod rewrite
RUN a2enmod ssl

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony