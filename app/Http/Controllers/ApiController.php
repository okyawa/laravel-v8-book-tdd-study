<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
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
        // 仮実装
        if (!$request->json('name')) {
            return response()
                ->make('', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
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
