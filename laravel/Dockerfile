# Laravelサービス用のDockerfile

# ベースイメージを指定
FROM composer:2

# libpq-devをインストール
RUN apk update && apk add --no-cache libpq

# PostgreSQLの開発用パッケージをインストール
RUN apk add --no-cache postgresql-dev

# PostgreSQLの拡張モジュールをインストール
RUN docker-php-ext-install pdo_pgsql
