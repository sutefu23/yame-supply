FROM php:8.1-apache

# timezone environment
ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  locale-gen en_US.UTF-8 && \
  localedef -f UTF-8 -i en_US en_US.UTF-8 && \
  mkdir /var/run/php-fpm && \
  docker-php-ext-install intl pdo_mysql zip bcmath && \
  docker-php-ext-configure gd --with-freetype --with-jpeg && \
  docker-php-ext-install -j$(nproc) gd && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.org

RUN curl https://get.volta.sh | bash
RUN $HOME/.volta/bin/volta install node


RUN a2enmod rewrite
# SSL
# RUN a2ensite default-ssl
# RUN a2enmod ssl
# RUN a2enmod wsgi
RUN service apache2 restart

ADD ./docker/laravel/config/000-default.conf /etc/apache2/sites-available
ADD ./docker/laravel/config/default-ssl.conf /etc/apache2/sites-available

WORKDIR /var/www/html