FROM ubuntu:18.04

MAINTAINER cuong.ngo

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils

RUN apt-get update && apt-get install -y language-pack-en

RUN locale-gen en_US.UTF-8
ENV LANGUAGE=en_US.UTF-8
ENV LC_ALL=en_US.UTF-8
ENV LC_CTYPE=UTF-8
ENV LANG=en_US.UTF-8
ENV TERM xterm


# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install "software-properties-common" (for the "add-apt-repository")
RUN apt-get update && apt-get install -y software-properties-common libmcrypt-dev php-pear libssl1.0-dev

# Add the "PHP 7" ppa
RUN add-apt-repository ppa:ondrej/php

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install PHP-CLI 7, some PHP extentions and some useful Tools with APT
RUN apt-get update && apt-get install -y --allow-remove-essential \
        libssl1.0-dev \
        nodejs-dev \
        node-gyp \
        libssl1.0-dev \
        php7.4\
        php7.4-fpm \
        php7.4-cli \
        php7.4-phpdbg \
        php7.4-common \
        php7.4-curl \
        php7.4-json \
        php7.4-xml \
        php7.4-mbstring \
        php7.4-mysql \
        php7.4-pgsql \
        php7.4-sqlite \
        php7.4-sqlite3 \
        php7.4-zip \
        php7.4-memcached \
        sqlite3 \
        libsqlite3-dev \
        git \
        curl \
        vim \
        nano \
        nodejs \
        php7.4-gd \
        npm \
        zip \
        unzip \
    && apt-get clean

# Install composer
RUN curl -s http://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

#Configure Nginx
RUN apt-get -yqq update; apt-get -yqq install nginx
ADD default.conf /etc/nginx/conf.d/default.conf
ADD nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /var/www/project
WORKDIR /var/www/project

CMD service php7.4-fpm start && nginx

EXPOSE 80
