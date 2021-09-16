『PHP フレームワーク Laravel Webアプリケーション開発 バージョン8.x対応』本の第11章「テスト駆動開発の実勢」のサンプルコードを写経したもの

- [Chapter 10まで写経したリポジトリ - okyawa/laravel-v8-book-study - GitHub](https://github.com/okyawa/laravel-v8-book-study)
- [サンプルコード掲載のGitHubリポジトリ一覧 | laravel-socym2021 - GitHub](https://github.com/laravel-socym2021)
- [Chapter 11 「テスト駆動開発の実践」のサンプルコード - laravel-socym2021/tdd_sample - GitHub](https://github.com/laravel-socym2021/tdd_sample)


---


# 0からの環境構築

## ローカル環境にDocker Desktopをインストール

- `Docker Desktop` のアプリをローカル環境にダウンロード
  - [Get Started with Docker - Docker](https://www.docker.com/get-started)
- `Docker Desktop` をローカル環境にインストール完了後、 `Docker` アプリは起動した状態にしておく

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
- `Ctrl` + `c` でキャンセルして起動終了

```sh
./vendor/bin/sail up
```


## Makefileの設置

- Docker関連のコマンドが簡単に打てるように、Makefileに使いそうなコマンドを記載

## Makefile内のコマンドでよく使うもの

### docker-composeの起動

```sh
make up
```

### docker-composerの停止

```sh
make down
```

### dockerコンテナ内のシェルに入る

```sh
make shell
```

### mysqlに入る

```sh
make mysql
```

### テストの実行

#### テスト全体を実行

```sh
make test
```

- テストの実行に関しては、PHPUnitを叩くよりもartisanコマンドのテスト実行を使った方が、結果が見やすい

```sh
php artisan test
```

#### 特定のテストファイルのみ実行

```sh
make test path=テストファイルのパス
```


## 不要ファイルの削除

- プロジェクト作成時に自動生成されるファイルのうち、今回の実装で利用しないものを削除

```sh
rm -rf tests/Feature/ExampleTest.php
rm -rf tests/Unit/ExampleTest.php
rm -rf database/migrations/*
```


## docker-compose.ymlにデータベーステスト用のMySQLを追加

- Laravel Sailで生成されるMySQLでは、データベースの追加ができないため、新たにMySQLのDockerコンテナを起動するように `docker-compose.yml` へ追記
- `services:` の中に、 `mysql.test` を追加

```yml
services:
    mysql.test:
        image: 'mysql:8.0'
        environment:
            MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
            MYSQL_DATABASE: '${DB_DATABASE}'
            MYSQL_USER: '${DB_USERNAME}'
            MYSQL_PASSWORD: '${DB_PASSWORD}'
            MYSQL_ALLOW_EMPTY_PASSWORD: 'yes'
        networks:
            - sail
```


## データベーステスト用のMySQLに入る


### テスト用MySQLのDockerコンテナに入る

```sh
make mysql-test-shell
```

もしくは

```sh
# テスト用MySQLのコンテナ名を確認
make ps
# テスト用MySQLのコンテナ名を指定して接続
docker exec -it {テストのdockerコンテナ名} bash
```

### テスト用MySQLのDockerコンテナ内からMySQLに入る

- 入力後に聞かれるパスワードは `.env` に記載しているパスワード

```sh
mysql -h 127.0.0.1 -P 3306 -u root -p
```

### データベーステスト用のデータベースを作成

```sql
create database test_database;
```


## モデルクラスにIDEヘルパーでphpDocsを付与

- Laravel IDE Helper Generator は、データベースに接続して、テーブル構造に応じたphpDocsを自動生成してくれる
- IDEでEloquentモデルのプロパティやリレーションが補完されるようになり、開発効率が飛躍的に向上

### doctrine/dbal と barryvdh/laravel-ide-helper のインストール

- リスト 11.3.2.8
```sh
composer require "doctrine/dbal" "barryvdh/laravel-ide-helper"
```

### ide-helper:models の実行

- リスト 11.3.2.9
```sh
php artisan ide-helper:models -W -R
```
