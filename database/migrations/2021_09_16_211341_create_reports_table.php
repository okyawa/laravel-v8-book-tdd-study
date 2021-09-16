<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * リスト 11.3.2.3: reportsテーブルのマイグレーションファイル
 *
 * このファイルの生成コマンド (※Eloquentモデル生成時にMigrationとFactoryのファイルも同時に生成)
 * $ php artisan make:model Report -f -m
 */
class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date');
            $table->bigInteger('customer_id', false, true);
            $table->text('detail');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
