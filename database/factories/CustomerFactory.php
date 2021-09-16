<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * リスト 11.3.2.12
 *
 * このファイルの生成コマンド (※Eloquentモデル生成時に、MigrationとFactoryのファイルも同時に生成)
 * $ php artisan make:model Customer -f -m
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}
