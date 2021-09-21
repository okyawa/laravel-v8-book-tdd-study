<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * リスト 11.3.2.3: customersテーブルのマイグレーションファイル
 *
 * このファイルの生成コマンド (※Eloquentモデル生成時に、MigrationとFactoryのファイルも同時に生成)
 * $ php artisan make:model Customer -f -m
 *
 * 未処理のマイグレーションをすべて実行
 * $ php artisan migrate
 * データベースを指定し、未処理のマイグレーションをすべて実行
 * $ php artisan migrate --database=test_database;
 */
class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
