<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * このファイルの生成コマンド
 * $ php artisan make:test ReportTest
 */
class ReportTest extends TestCase
{
    /**
     * 11-2-2: Todoリストを作成する
     *
     * APIの各エンドポイントに指定メソッドでアクセス可能にする実装から開始。
     * 最初のTodoリストは、下記のようなものになる。
     *
     * - [ ] api/customersにGETメソッドでアクセスできる
     * - [ ] api/customersにPOSTメソッドでアクセスできる
     * - [ ] api/customers/{customer_id}にGETメソッドでアクセスできる
     * - [ ] api/customers/{customer_id}にPUTメソッドでアクセスできる
     * - [ ] api/customers/{customer_id}にDELETEメソッドでアクセスできる
     * - [ ] api/reportsにGETメソッドでアクセスできる
     * - [ ] api/reportsにPOSTメソッドでアクセスできる
     * - [ ] api/reports/{report_id}にGETメソッドでアクセスできる
     * - [ ] api/reports/{report_id}にPUTメソッドでアクセスできる
     * - [ ] api/reports/{report_id}にDELETEメソッドでアクセスできる
     */

    /**
     * リスト 11.2.2.3
     * Todoリスト項目をそのままメソッド名として、コード例に示すメソッドを追加
     *
     * 11-2-3: テストメソッドに何をどのように書くか
     * テストメソッドには最低限、結果を取得処理の「実行」と結果の「検証」を記述する必要がある。
     *
     * リスト 11.2.3.1 先に「検証」部分を記述
     * そもそも実装がない状態からテストを記述する方法であるテスト駆動開発では、
     * 最初に「検証」部分から記述するケースがよくある。
     * 「検証」部分を記述しただけでテストを実行し、失敗させ、エラーの内容を確認する。
     * エラーには「ErrorException: Undefined variable $response」と表示されている状態。
     * テストの失敗を確認することで、これから「しなければいけないこと」が明確になり、
     * 開発プロセスにリズムが生まれる。
     *
     * リスト 11.2.3.3 「実行」部分を記述
     * テストの失敗が教えてくれた通り、$responseを取得する実行部分を記述する。
     * 再びテストを実行し、テストが「失敗すること」を確認し、実行結果のエラー内容が
     * 「Expected response status code [200] but received 404.」
     * に変わったことを確認できる。
     *
     * @test
     */
    public function api_customerにGETリクエストでアクセスできる(): void
    {
        // 後から「実行」部分を記述
        $response = $this->get('api/customers');
        // 先に「検証」部分を記述
        $response->assertStatus(200);
    }
}
