<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * リスト 11.3.2.5: Customerクラスにリレーションを設定
 *
 * このファイルの生成コマンド (※MigrationとFactoryのファイルも同時に生成)
 * $ php artisan make:model Customer -f -m
 */

class Customer extends Model
{
    use HasFactory;

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
