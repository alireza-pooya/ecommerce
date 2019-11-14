<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\ProductResourceCollection;
use App\Http\Resources\QuantityResource;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuantityController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getQuantity(Request $request)
    {
        $quantity = Store::whereId($request->store_id)->pluck('quantity')->first();

        return response([
            'data'   => $quantity,
            'status' => 'success'
        ],200);
    }
}
