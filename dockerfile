FROM php:7.4-fpm
#FROM ubuntu:18.04

# Copy composer.lock and composer.json into the working directory
COPY composer.lock composer.json /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies for the operating system software
 # RUN apt-get update && apt-get install -y \
  #   build-essential \
  #   libpng-dev \
 # libjpeg62-turbo-dev \
 #   libfreetype6-dev \
 #  locales \
 #   zip \
 #   jpegoptim optipng pngquant gifsicle \
 #   vim \
 #  libzip-dev \
 #    unzip \
 #    git \
 #    libonig-dev \
 #   curl

# RUN apt-get update && apt-get install -y php7.4-{bcmath,bz2,intl,gd,mbstring,mysql,zip,common}
# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
# RUN docker-php-ext-install pdo_mysql   
# RUN docker-php-ext-install zip
# RUN docker-php-ext-install exif
# RUN docker-php-ext-install pcntl
# RUN docker-php-ext-install mbstring
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
# RUN docker-php-ext-install gd
# RUN docker-php-ext-install pdo_mysql zip exif pcntl
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
# RUN docker-php-ext-install gd
# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents to the working directory
COPY . /var/www/html
# Assign permissions of the working directory to the www-data user
 RUN chown -R www-data:www-data \
         /var/www/html/storage \
         /var/www/html/bootstrap/cache

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9093
CMD ["php-fpm"]
