# ベースとなるPHP FPMイメージ
FROM php:8.2-fpm

# 必要なシステムパッケージのインストールとロケール設定
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        libzip-dev \
        libonig-dev \
        locales && \
    rm -rf /var/lib/apt/lists/*

# ロケールの設定
RUN sed -i -e 's/# ja_JP.UTF-8 UTF-8/ja_JP.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=ja_JP.UTF-8
ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_ALL ja_JP.UTF-8

# PHP拡張機能のインストール
RUN docker-php-ext-install \
    mysqli \
    pdo_mysql \
    zip \
    mbstring

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# FuelPHPアプリケーションのファイルをコンテナにコピー
# ホスト側のカレントディレクトリの内容（プロジェクトルート全体）をコンテナの/var/www/htmlにコピー
COPY . /var/www/html 

# 作業ディレクトリを設定
WORKDIR /var/www/html

# コンテナ起動時に実行されるコマンド
CMD ["php-fpm"]