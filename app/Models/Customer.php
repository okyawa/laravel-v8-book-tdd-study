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

/**
 * リスト 11.3.2.9 ide-helper:modelを実行してphpDocsを自動生成
 *
 * $ php artisan ide-helper:models -W -R
 */

/**
 * App\Models\Customer
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $reports
 * @property-read int|null $reports_count
 * @method static \Database\Factories\CustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use HasFactory;

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
