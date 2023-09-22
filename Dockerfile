# Laravelサービス用のDockerfile

# ベースイメージを指定
FROM php:8.1-fpm

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PostgreSQLの拡張モジュールをインストール
RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo_pgsql

# unzipユーティリティをインストール
RUN apt-get install -y unzip

# Laravelプロジェクトを作成
WORKDIR /var/www
RUN composer create-project --prefer-dist laravel/laravel laravel
