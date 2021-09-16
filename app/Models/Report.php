<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * リスト 11.3.2.6: Reportクラスにリレーションを設定
 *
 * このファイルの生成コマンド (※MigrationとFactoryのファイルも同時に生成)
 * $ php artisan make:model Report -f -m
 */

class Report extends Model
{
    use HasFactory;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
