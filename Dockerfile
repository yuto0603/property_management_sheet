FROM php:8.1-apache

RUN a2enmod rewrite

# 必要なシステムパッケージをインストール (oniguruma-dev など)
RUN apt-get update && apt-get install -y \
    locales \ 
    libonig-dev \
    libzip-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype6-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# PHPに必要な拡張機能をインストール
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql mbstring gd zip intl opcache pdo

# ApacheのドキュメントルートをFuelPHPのpublicディレクトリに設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
#RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# ApacheのAllowOverrideをAllに設定
#RUN echo "<Directory /var/www/html/public>" >> /etc/apache2/apache2.conf \
 #   && echo "    AllowOverride All" >> /etc/apache2/apache2.conf \
  #  && echo "</Directory>" >> /etc/apache2/apache2.conf

# Composer のインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# コンテナ内のタイムゾーンを設定
ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# ロケールを設定 (en_US.UTF-8 と ja_JP.UTF-8 を生成)
RUN localedef -i en_US -f UTF-8 en_US.UTF-8
RUN localedef -i ja_JP -f UTF-8 ja_JP.UTF-8 
ENV LANG ja_JP.UTF-8 
ENV LC_ALL ja_JP.UTF-8 

# PHPの設定ファイル (php.ini) にロケールを明示的に追加
RUN echo "date.timezone=Asia/Tokyo" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "default_charset=UTF-8" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "mbstring.language=Japanese" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "mbstring.internal_encoding=UTF-8" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "intl.default_locale=ja_JP.UTF-8" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "intl.error_level=0" >> /usr/local/etc/php/conf.d/php.ini