FROM php:7.3-cli

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Enable PDO-Mysql
RUN docker-php-ext-install pdo_mysql

# Enable OPCache
RUN docker-php-ext-install opcache

WORKDIR /project

CMD php vendor/bin/codecept clean; php vendor/bin/codecept run functional,unit