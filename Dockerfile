# ベースイメージとして公式のPHPイメージを使用
FROM php:7.4-apache

# 作業ディレクトリを設定
WORKDIR /var/www/html

# composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# プロジェクトのファイルをコピー
COPY . /var/www/html

# composer install を実行して依存関係をインストール
RUN composer install

# ポート80を公開
EXPOSE 80

# サーバーを起動
CMD ["apache2-foreground"]
