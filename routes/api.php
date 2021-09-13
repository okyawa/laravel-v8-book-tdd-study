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
