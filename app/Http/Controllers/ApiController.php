<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * リスト 11.5.1.6
 *
 * このファイルの生成コマンド
 * $ php artisan make:controller ApiController
 */
class ApiController extends Controller
{
    public function getCustomers(): JsonResponse
    {
        return response()->json(
            Customer::query()
                ->select(['id', 'name'])
                ->get()
        );
    }

    public function postCustomers(Request $request)
    {
        /**
         * リスト 11.5.2.2 独自のバリデーションからLaravelのvalidateメソッドを使った実装に変更
         *
         * Laravelなどのフレームワークを利用する利点の1つは、豊富に備わっている便利な機能を利用できること。
         * フレームワークのメソッドとしてカプセル化されているため、複雑な実装出会っても実にシンプルに記述できる。
         * リファクタリングの方向として、フレームワークの標準機能を利用する流れに寄せるのは、
         * 「きれいな実装」に近付ける意味でも、将来の良好なメンテナンス性でも良い戦略といえる。
         *
         * リスト 11.5.3.6 エラーメッセージの日本語化
         *
         * validateメソッドは第3引数で個別にエラーメッセージを指定できる。
         */
        $this->validate(
            $request,
            ['name' => 'required'],
            ['name.required' => ':attribute は必須項目です']
        );

        $customer = new Customer();
        $customer->name = $request->json('name');
        $customer->save();
    }

    public function getCustomer()
    {
    }

    public function putCustomer()
    {
    }

    public function deleteCustomer()
    {
    }

    public function getReports()
    {
    }

    public function postReport()
    {
    }

    public function getReport()
    {
    }

    public function putReport()
    {
    }

    public function deleteReport()
    {
    }
}
