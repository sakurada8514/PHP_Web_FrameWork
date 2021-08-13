FROM php:8.0-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

#composer
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

#必要なパッケージインストール
RUN apt-get update && \
  apt-get -y install git unzip libzip-dev libicu-dev libonig-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath && \
  pecl install xdebug && \
  docker-php-ext-enable xdebug


# #nodejs,npm
# RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
# RUN apt-get install -y nodejs

#設定反映
COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /work