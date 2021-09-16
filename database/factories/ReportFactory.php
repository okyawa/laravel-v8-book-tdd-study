<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * リスト 11.3.2.13
 *
 * このファイルの生成コマンド (※Eloquentモデル生成時にMigrationとFactoryのファイルも同時に生成)
 * $ php artisan make:model Report -f -m
 *
 * reportテーブルのcustomer_idフィールドには外部キー制約があるため、ここでは指定せず、
 * 実際にfactoryメソッドで呼ぶ際に指定する
 *
 * Fakerは、config/app.phpでfaker_localeにja_JPを指定することで、
 * 日本語を扱えるようになる
 */
class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'visit_date' => $this->faker->date(),
            'detail' => $this->faker->realText(),
        ];
    }
}
