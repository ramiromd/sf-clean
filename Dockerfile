FROM php:8.4-fpm-alpine

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && apk add --update linux-headers \
    && pecl install xdebug-3.5.0 \
	&& docker-php-ext-enable xdebug

RUN apk add bash curl

# INSTALL COMPOSER
WORKDIR /tmp
RUN curl -s https://getcomposer.org/installer -o composer-setup \
	&& php composer-setup --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

EXPOSE 9000

CMD ["php-fpm"]