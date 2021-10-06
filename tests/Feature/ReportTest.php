<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * このファイルの生成コマンド
 * $ php artisan make:test ReportTest
 *
 * リスト 11.2.7.1 実装後のテスト
 */
class ReportTest extends TestCase
{
    /**
     * リスト 11.4.11: RefreshDatabaseトレイトを使ってテスト用データベースのマイグレーション(初期化)
     *
     * 用意したマイグレーションがテスト実行時に自動で呼ばれるようになる
     */
    use RefreshDatabase;

    /**
     * リスト 11.4.1.2: setUpメソッド内でシーダーを実行
     *
     * 初期データの投入には、setUpメソッド内でartisanコマンドを使ってdb:seedコマンドを呼び出す。
     * 用意したテスト用データシーダークラスを--classで指定する。
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'TestDataSeeder']);
    }

    /**
     * 11-2-2: Todoリストを作成する
     *
     * APIの各エンドポイントに指定メソッドでアクセス可能にする実装から開始。
     * 最初のTodoリストは、下記のようなものになる。
     *
     * - [x] api/customersにGETメソッドでアクセスできる
     *     - [x] api/customersにGETメソッドでアクセスするとJSONが返却される
     *     - [x] api/customersにGETメソッド取得できる顧客情報のJSON形式は要求通りである
     *     - [x] api/customersにGETメソッドで返却される顧客情報は2件である
     * - [x] api/customersにPOSTメソッドでアクセスできる
     *     - [ ] api/customersに顧客名をPOSTするとcustomersテーブルにそのデータが追加される
     * - [x] api/customers/{customer_id}にGETメソッドでアクセスできる
     * - [x] api/customers/{customer_id}にPUTメソッドでアクセスできる
     * - [x] api/customers/{customer_id}にDELETEメソッドでアクセスできる
     * - [x] api/reportsにGETメソッドでアクセスできる
     * - [x] api/reportsにPOSTメソッドでアクセスできる
     * - [x] api/reports/{report_id}にGETメソッドでアクセスできる
     * - [x] api/reports/{report_id}にPUTメソッドでアクセスできる
     * - [x] api/reports/{report_id}にDELETEメソッドでアクセスできる
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
    public function api_customersにGETリクエストでアクセスできる(): void
    {
        // 後から「実行」部分を記述
        $response = $this->get('api/customers');
        // 先に「検証」部分を記述
        $response->assertStatus(200);
    }

    /**
     * リスト11.4.2.1 データベースが絡むテスト
     * レスポンスがJSONであることを確かめるテストを先に記述し、
     * テストを追加したら直ぐに実行して失敗することを確認する
     *
     * @test
     */
    public function api_customersにGETメソッドでアクセスするとJSONが返却される(): void
    {
        $response = $this->get('api/customers');
        $this->assertThat($response->content(), $this->isJson());
    }

    /**
     * リスト 11.4.5.3 JSON形式の確認
     *
     * @test
     */
    public function api_customerにGETメソッドで取得できる顧客情報のJSON形式は要件通りである()
    {
        $response = $this->get('api/customers');
        $customers = $response->json();
        $customer = $customers[0];
        $this->assertSame(['id', 'name'], array_keys($customer));
    }

    /**
     * リスト 11.4.6
     *
     * この要件はリスト 11.4.5.5で既に実装済みだが、
     * 続くリファクタリングがこの要件を壊してしまうことに備えて、
     * こうした要件に対してもテストを追加
     *
     * @test
     */
    public function api_customersにGETメソッドでアクセスすると2件の顧客リストが返却される()
    {
        $response = $this->get('api/customers');
        $response->assertJsonCount(2);
    }

    /**
     * リスト 11.2.5.1
     *
     * @test
     */
    public function api_customersにPOSTメソッドでアクセスできる(): void
    {
        /**
         * リスト 11.4.8.2 失敗するテストを修正
         *
         * 既存のテストが不十分だと判明した場合はもちろん、
         * テスト自体を修正することになる。
         */
        $params = [
            'name' => 'customer_name',
        ];
        $response = $this->postJson('api/customers', $params);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_customers_customer_idにGETメソッドでアクセスできる(): void
    {
        $response = $this->get('api/customers/1');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_customers_customer_idにPUTメソッドでアクセスできる(): void
    {
        $response = $this->PUT('api/customers/1');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_customers_customer_idにDELETEメソッドでアクセスできる(): void
    {
        $response = $this->delete('api/customers/1');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_reportsにGETメソッドでアクセスできる(): void
    {
        $response = $this->get('api/reports');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_reportsにPOSTメソッドでアクセスできる(): void
    {
        $response = $this->post('api/reports');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_reports_report_idにGETメソッドでアクセスできる(): void
    {
        $response = $this->get('api/reports/1');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_reports_report_idにPUTメソッドでアクセスできる(): void
    {
        $response = $this->put('api/reports/1');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function api_reports_report_idにDELETEメソッドでアクセスできる(): void
    {
        $response = $this->delete('api/reports/1');
        $response->assertStatus(200);
    }

    /**
     * 1つのテストメソッドに検証は1つが原則
     *
     * リスト 11.2.6.1 複数の検証を記入する例
     *
     * 1つのテストに複数の検証をまとめて記述することも可能だが、
     * テストが失敗したときに、どの検証が失敗したのかが分かりにくくなる。
     *
     * 原則
     * 1. テストメソッドに何を検証するテストなのかが明確に分かる名前を付ける
     * 2. そのテストメソッドの名前で表現された検証を1つ書く
     *
     * @test
     */
    public function すべてのエンドポイントへアクセスできる(): void
    {
        $response = $this->get('api/customers');
        $response->assertStatus(200);
        $params = [
            'name' => 'customer_name',
        ];
        $response = $this->postJson('api/customers', $params);
        $response->assertStatus(200);
        $response = $this->get('api/customers/1');
        $response->assertStatus(200);
        $response = $this->PUT('api/customers/1');
        $response->assertStatus(200);
        $response = $this->delete('api/customers/1');
        $response->assertStatus(200);
        $response = $this->get('api/reports');
        $response->assertStatus(200);
        $response = $this->post('api/reports');
        $response->assertStatus(200);
        $response = $this->get('api/reports/1');
        $response->assertStatus(200);
        $response = $this->put('api/reports/1');
        $response->assertStatus(200);
        $response = $this->delete('api/reports/1');
        $response->assertStatus(200);
    }

    /**
     * リスト 11.4.7
     *
     * @test
     */
    public function api_customersに顧客名をPOSTするとcustomersテーブルにそのデータが追加される(): void
    {
        $params = [
            'name' => '顧客名',
        ];
        // $this->postJson()メソッドは、第2引数で指定する配列をJSON形式にしてPOSTするもの
        $this->postJson('api/customers', $params);
        // 実際にデータを追加できているかを検証
        $this->assertDatabaseHas('customers', $params);
    }
}
