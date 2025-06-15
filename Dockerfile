FROM php:8.2-apache

# 作業ディレクトリを設定
WORKDIR /var/www/html

# ComposerとGitをインストール
RUN apt-get update && apt-get install -y \
    locales \ 
    libonig-dev \
    libzip-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype6-dev \
    libicu-dev \
    git \
    && rm -rf /var/lib/apt/lists/*

# PHP拡張機能をインストール
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql mbstring gd zip intl opcache pdo

# Apacheのmod_rewriteを有効化
RUN a2enmod rewrite

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# FuelPHPのプロジェクトファイルをコンテナにコピー
COPY . /var/www/html/

# Gitの「dubious ownership」エラーを回避するための設定
RUN git config --global --add safe.directory /var/www/html

# Composerの依存関係をインストール
# composer.json に platform 設定を記述したので、ここからはオプションを削除
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-interaction --ignore-platform-reqs

# ApacheのドキュメントルートをFuelPHPのpublicディレクトリに設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -i -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN echo "<Directory ${APACHE_DOCUMENT_ROOT}>" >> /etc/apache2/apache2.conf \
    && echo "    AllowOverride All" >> /etc/apache2/apache2.conf \
    && echo "</Directory>" >> /etc/apache2/apache2.conf

# コンテナ内のタイムゾーンとロケールを設定
ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
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