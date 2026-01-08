FROM php:8.3-apache

ENV DEBIAN_FRONTEND=noninteractive

# Install build deps, configure and install extensions, then remove build deps
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
      build-essential \
      pkg-config \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
      libzip-dev \
      zlib1g-dev \
      libonig-dev \
      libcurl4-openssl-dev \
      libxml2-dev \
      unzip \
      git \
      ca-certificates \
    ; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" mysqli pdo_mysql zip gd mbstring curl; \
    apt-get remove -y --purge \
      build-essential pkg-config \
      libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev zlib1g-dev libonig-dev libcurl4-openssl-dev libxml2-dev \
    && apt-get autoremove -y; \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy app files and set ownership to www-data to avoid permission issues
COPY --chown=www-data:www-data . /var/www/html

# Create assets alias & allow access (fixed Directory path with leading slash)
RUN printf "%s\n" \
  "Alias /assets/ /var/www/html/assets/" \
  "<Directory /var/www/html/assets/>" \
  "    Require all granted" \
  "    AllowOverride All" \
  "</Directory>" \
  > /etc/apache2/conf-enabled/assets-alias.conf

# Enable commonly-needed modules
RUN a2enmod rewrite

EXPOSE 80
