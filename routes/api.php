<?php

use Illuminate\Http\Request;
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
Route::get('customers', function () {});

/**
 * リスト 11.2.5.3
 * 2つ目以降のTodoも同様に、ステータスコードを返すだけの最低限の状態で実装する。
 */
Route::post('customers', function () {});
Route::get('customers/{customer_id}', function () {});
Route::put('customers/{customer_id}', function () {});
Route::delete('customers/{customer_id}', function () {});
Route::get('reports', function() {});
Route::post('reports', function() {});
Route::get('reports/{report_id}', function() {});
Route::put('reports/{report_id}', function() {});
Route::delete('reports/{report_id}', function() {});
