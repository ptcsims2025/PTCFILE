FROM php:8.3-apache

# Install build deps required for extensions, configure and install PHP extensions
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
      libzip-dev \
      zlib1g-dev \
      libonig-dev \
      unzip \
      git \
      ca-certificates \
      && docker-php-ext-configure gd --with-freetype --with-jpeg \
      && docker-php-ext-install -j"$(nproc)" mysqli pdo_mysql zip gd mbstring curl \
      && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false \
      && rm -rf /var/lib/apt/lists/*

# Set working dir
WORKDIR /var/www/html

# Copy application files and set ownership for Apache
COPY --chown=www-data:www-data . /var/www/html

# Create assets alias & allow access (fixed Directory path with leading slash)
RUN printf "%s\n" \
  "Alias /assets/ /var/www/html/assets/" \
  "<Directory /var/www/html/assets/>" \
  "    Require all granted" \
  "    AllowOverride All" \
  "</Directory>" \
  > /etc/apache2/conf-enabled/assets-alias.conf

# Enable rewrite module (common for many PHP apps)
RUN a2enmod rewrite

EXPOSE 80
