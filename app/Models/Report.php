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

/**
 * リスト 11.3.2.9 ide-helper:modelを実行してphpDocsを自動生成
 *
 * $ php artisan ide-helper:models -W -R
 */

/**
 * App\Models\Report
 *
 * @property-read \App\Models\Customer $customer
 * @method static \Database\Factories\ReportFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @mixin \Eloquent
 */
class Report extends Model
{
    use HasFactory;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
