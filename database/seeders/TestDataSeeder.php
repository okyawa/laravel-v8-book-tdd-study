<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Report;
use Illuminate\Database\Seeder;

/**
 * リスト 11.3.3.2
 *
 * このファイルの生成コマンド
 * $ php artisan make:seeder TestDataSeeder
 */
class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * リレーションのあるデータ投入にはeachメソッドが利用できる
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->count(2)->create()->each(function (Customer $customer) {
            Report::factory()->count(2)->make()->each(function (Report $report) use ($customer) {
                $customer->reports()->save($report);
            });
        });
    }
}
