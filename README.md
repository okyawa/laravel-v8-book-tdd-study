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


## データベーステスト用のデータベースを作成

- sailコマンドで入るMySQLではDBを作成できないため、MySQLのdockerコンテナに入り、rootでMySQLに入ることでDB作成

### MySQLのコンテナに入る

- `docker ps` コマンドでMySQLコンテナの名前を調べる
```sh
docker ps
```

> CONTAINER ID   IMAGE          COMMAND                  CREATED          STATUS                    PORTS                                                  NAMES
> f920d52e098a   sail-8.0/app   "start-container"        17 minutes ago   Up 17 minutes             0.0.0.0:80->80/tcp, :::80->80/tcp, 8000/tcp            laravel-v8-book-tdd-study_laravel.test_1
> 9760b31515b7   mysql:8.0      "docker-entrypoint.s…"   17 minutes ago   Up 17 minutes (healthy)   0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/tcp   laravel-v8-book-tdd-study_mysql_1
> 789bc0fabe0c   mysql:8.0      "docker-entrypoint.s…"   17 minutes ago   Up 17 minutes             3306/tcp, 33060/tcp                                    laravel-v8-book-tdd-study_mysql.test_1

- 調べたMySQLコンテナ名を使って、シェルに入る
```sh
docker exec -it laravel-v8-book-tdd-study_mysql_1 bash
```

### MySQLにrootで入る

- パスワードは `.env` に記載しているパスワード値
```sh
mysql -u root -p
```

### テスト実行用のデータベースを作成

- `test_database` の名前でデータベースを作成
```sql
create database test_database;
```

### 追加したデータベースの権限設定

- 作成した `test_database` のデータベースを `sail` ユーザーが使えるようにする
```sql
GRANT ALL ON test_database.* TO 'sail';
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

#### PHPDocsにモデル定義を書き込まない形式

- `--nowrite` オプションを付けてコマンド実行後、rootディレクトリにIDE用補完用の `_ide_helper_models.php` が生成される
```sh
php artisan ide-helper:model --nowrite
```

- `.gitignore` に追加
```
# ide-helper
_ide_helper.php
_ide_helper_models.php
.phpstorm.meta.php
````
