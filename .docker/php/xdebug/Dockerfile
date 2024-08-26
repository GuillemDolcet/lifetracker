FROM ubuntu

ENV XDEBUG_PORT=9003
ENV XDEBUG_HOST=

RUN add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y php8.3-cli php8.3-common php8.3-curl php8.3-gd \
        php8.3-intl php8.3-mbstring php8.3-opcache php8.3-pgsql \
        php8.3-readline php8.3-soap php8.3-xml php8.3-zip php8.3-bcmath \
        php8.3-tidy php8.3-xdebug php8.3-ssh2 php-memcached php-redis php8.3-imagick \
        software-properties-common apt-transport-https \
        php8.3-dev build-essential \
    && apt-get clean \
    && apt-get autoclean \
    && apt-get autoremove -y --purge \
    && rm -fr /var/lib/apt/lists/*

COPY ./20-xdebug.ini /etc/php/8.3/cli/conf.d/20-xdebug.ini

RUN echo -e "\
; Enable opcache + JIT\n\
opcache.enable=1\n\
opcache.enable_cli=1\n\
opcache.jit_buffer_size=128M\n\
opcache.jit=tracing" >> /etc/php/8.3/cli/conf.d/10-opcache.ini

RUN echo -e "\
upload_max_filesize = 50M\n\
post_max_size = 50M\n\
max_execution_time = 60" >> /etc/php/8.3/cli/php.ini

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin/ --filename=composer

USER root
WORKDIR /
