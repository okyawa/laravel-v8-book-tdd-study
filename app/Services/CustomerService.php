<?php

namespace App\Services;

use App\Models\Customer;

/**
 * リスト 11.5.5.1
 *
 * 将来的な機能拡張やメンテナンス性を考慮すると、
 * ビジネスロジックはコントローラと別のサービスクラスを作成して分離すべき。
 * コントローラに直接記述してた実装をCustomerServiceクラスとして分離。
 *
 * コントローラ(ApiController)側からは、
 * メソッドインジェクションを使って下記のサービスクラスを呼び出す。
 *
 * リファクタリング後、テストの実行と確認も忘れないように。
 *
 * サービスクラスをへの分離にはもう１つメリットがあり、
 * サービスクラスに対するユニットテストの作成が可能になること。
 * ビジネスロジックは、サービスクラスに対するユニットテストでその機能を担保することで、
 * フィーチャテストではあくまでもレスポンスを確認するといった切り分けも可能になる。
 */
class CustomerService
{
    /**
     * リスト 11.5.5.4 元の実装を移植
     */
    public function getCustomers()
    {
        return Customer::query()->select(['id', 'name'])->get();
    }

    /**
     * リスト 11.4.4.6
     *
     * @param string $name
     */
    public function addCustomers(string $name)
    {
        $customer = new Customer();
        $customer->name = $name;
        $customer->save();
    }
}
