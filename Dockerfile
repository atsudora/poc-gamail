# ベースイメージとして公式のPHPイメージを使用
FROM php:7.4-apache

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip

# 作業ディレクトリを設定
WORKDIR /var/www/html

# composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# プロジェクトのファイルをコピー
COPY . /var/www/html

# composer install を実行して依存関係をインストール
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ポート80を公開
EXPOSE 80

# サーバーを起動
CMD ["apache2-foreground"]
