# Rese（リーズ）
飲食店の予約サイトのアプリです。
![サンプル画像](./src/public/img/RISEトップページ.jpg)
## 上級模擬案件
## 機能一覧
- 会員登録機能
- ログイン機能
- いいね機能
- 店舗検索機能
- 店舗予約機能
## 使用技術
- PHP 7.4.9
- Laravel 8.83.27
- MySQL 8.0.26
## テーブル設計
![サンプル画像](./src/public/img/テーブル設計1.jpg)
![サンプル画像](./src/public/img/テーブル設計2.jpg)
## ER図
![サンプル画像](./src/public/img/ER図.jpg)
# 環境構築
**Dockerビルド**
1. `git clone git@github.com:hiro8787/advance-laravel.git`
2. `DockerDesktopアプリを立ち上げる`
3. `docker-compose up -d --build`

> *`no matching manifest for linux/arm64/v8 in the manifest list entries`とエラーメッセージが出る場合
docker-compose.ymlファイルの「mysql」と「phpmyadmin」内に「platform」の項目を追加で記載してください*
``` bash
mysql:
    platform: linux/x86_64(この文を追加)
    image: mysql:8.0.26
    environment:
```
``` bash
phpmyadmin:
    platform: linux/x86_64(この文を追加)
    image: phpmyadmin/phpmyadmin
    environment:
```
**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```
6. マイグレーションの実行
``` bash
php artisan migrate
```
7. シーディングの実行
``` bash
php artisan db:seed
```

## 環境開発
- http://localhost/
- phpMyAdmin：http://localhost:8080/