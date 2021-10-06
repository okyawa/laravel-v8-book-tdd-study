<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * リスト 11.2.4.1 ステータスコード200が返却される最低限の実装
 * レスポンス内容を考慮せず、とりあえず何も返却しない状態で実装する。
 * あくまでも「200のレスポンス」が返ることだけを実装する。
 * 実装後、テストをもう一度実行し、テストが成功ことが確認できれば、
 * 1つ目のTodoは完了。
 */
// Route::get('customers', function () {});

/**
 * リスト 11.2.5.3
 * 2つ目以降のTodoも同様に、ステータスコードを返すだけの最低限の状態で実装する。
 *
 * リスト 11.2.7.2
 */
// Route::post('customers', function () {});
Route::get('customers/{customer_id}', function () {});
Route::put('customers/{customer_id}', function () {});
Route::delete('customers/{customer_id}', function () {});
Route::get('reports', function() {});
Route::post('reports', function() {});
Route::get('reports/{report_id}', function() {});
Route::put('reports/{report_id}', function() {});
Route::delete('reports/{report_id}', function() {});

/**
 * リスト 11.4.3.1 仮実装
 *
 * 本来であれば、データベースに接続して値を取得し、
 * その値を返却する、一連の動作を記述すべきだが、
 * まずは、テストを成功させることだけを考えて
 * 「仮に」実装してしまう。
 *
 * 仮実装の目的の1つは、テストが成功する状態を素早く作ること。
 * 一旦テストが成功することを確認してから、
 * テストが成功する状態を保ったまま実装をリファクタリングしていく、
 * テスト駆動開発のサイクルを早い段階で作ってしまう。
 *
 * 仮実装のもう1つの重要な目的が、テスト側に間違いが無いのかの確認を用意にすること。
 * 成功するはずのテストがなぜか失敗してしまう場合、実装が複雑であればあるほど、
 * その失敗が実装に聞いするものなのか、それともテスト側に起因するものなのか、
 * 切り分けが困難になってしまう。
 * そこで、どう考えても間違いようのない程単純な実装 (ここでは空のJSONを返すだけ) で、
 * 一旦意図する状態を完成させ、テスト側に間違いがないかを先に確認する。
 */
// route::get('customers', function () {
//     return response()->json();
// });

/**
 * 11-4-4 最初のリファクタリング
 *
 * 仮実装でテストが成功したところで、テストが成功し続けることを確認しながら、
 * リファクタリングを続ける。
 * 実際に\App\Customerモデルから全ての結果を取得し返却する実装にリファクタリングする。
 *
 * リファクタリングが済めばテストを再実行して、テストが失敗しないことを確認する。
 * 既に成功するテストが存在することで、その後のリファクタリング機能が損なわれないことを担保できる。
 */
// route::get('customers', function () {
//     return response()->json(Customer::query()->get());
// });

/**
 * リスト 11.4.5.5 返却する項目を指定
 */
route::get('customers', function () {
    return response()
        ->json(Customer::query()
        ->select(['id', 'name'])
        ->get());
});

/**
 * リスト 11.4.7.3 データの保存を実装
 */
// Route::post('customers', function (Request $request) {
//     $customer = new Customer();
//     $customer->name = $request->json('name');
//     $customer->save();
// });

/**
 * リスト 11.4.9.3 仮実装でバリデーション
 */
Route::post('customers', function (Request $request) {
    // 仮実装
    if (!$request->json('name')) {
        return response()
            ->make('', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $customer = new Customer();
    $customer->name = $request->json('name');
    $customer->save();
});
