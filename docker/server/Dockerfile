FROM ubuntu:16.04

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
RUN apt-get update && apt-get install -y \
    software-properties-common libmcrypt-dev php-pear

# Add the "PHP 7" ppa
RUN add-apt-repository -y \
    ppa:ondrej/php

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install PHP-CLI 7, some PHP extentions and some useful Tools with APT
RUN apt-get update && apt-get install -y --allow-remove-essential \
        php7.2-fpm \ 
        php7.2-cli \
        php7.2-dev \
        php7.2-phpdbg \
        php7.2-common \
        php7.2-curl \
        php7.2-json \
        php7.2-xml \
        php7.2-mbstring \
        php7.2-mysql \
        php7.2-pgsql \
        php7.2-sqlite \
        php7.2-sqlite3 \
        php7.2-zip \
        php7.2-memcached \
        sqlite3 \
        libsqlite3-dev \
        git \
        curl \
        vim \
        nano \
        nodejs \
        php7.2-gd \
        npm

#Configure Nginx
RUN apt-get -yqq update; apt-get -yqq install nginx
ADD default.conf /etc/nginx/conf.d/default.conf
ADD nginx.conf /etc/nginx/nginx.conf

RUN service php7.2-fpm start

RUN mkdir -p /var/www/project
WORKDIR /var/www/project

CMD service php7.2-fpm start && nginx

EXPOSE 80
