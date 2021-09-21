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
 *
 * ※DBにテーブル追加後に実行するとプロパティの定義も反映される。
 */

/**
 * App\Models\Report
 *
 * @property int $id
 * @property string $visit_date
 * @property int $customer_id
 * @property string $detail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @method static \Database\Factories\ReportFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereVisitDate($value)
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
