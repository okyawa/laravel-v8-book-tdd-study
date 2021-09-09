『PHP フレームワーク Laravel Webアプリケーション開発 バージョン8.x対応』本の第11章「テスト駆動開発の実勢」のサンプルコードを写経したもの

- [Chapter 10まで写経したリポジトリ - okyawa/laravel-v8-book-study - GitHub](https://github.com/okyawa/laravel-v8-book-study)
- [サンプルコード掲載のGitHubリポジトリ一覧 | laravel-socym2021 - GitHub](https://github.com/laravel-socym2021)
- [Chapter 11 「テスト駆動開発の実践」のサンプルコード - laravel-socym2021/tdd_sample - GitHub](https://github.com/laravel-socym2021/tdd_sample)


---


# 0からの環境構築


## Laravel のプロジェクト作成

- プロジェクト名が `laravel-v8-book-tdd-study` の場合
``` sh
composer create-project laravel/laravel laravel-v8-book-tdd-study --prefer-dist
```

## Laravel Sailのインストール

```sh
composer require laravel/sail --dev
```

```sh
php artisan sail:install
```

> Which services would you like to install? [mysql]:
>  [0] mysql
>  [1] pgsql
>  [2] mariadb
>  [3] redis
>  [4] memcached
>  [5] meilisearch
>  [6] minio
>  [7] mailhog
>  [8] selenium
> > 0
> 
> Sail scaffolding installed successfully.


## Laravel Sailを立ち上げる

- Dockerを起動している状態で、下記のコマンドを実行し、Sailが立ち上がるかを確認

```sh
./vendor/bin/sail up
```
