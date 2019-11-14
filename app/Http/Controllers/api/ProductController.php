<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\ProductResourceCollection;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getSize(Request $request)
    {
        $store = Store::where('product_id',$request->product_id)->where('color',$request->colorCode)->get();
        return response([
            'data' => [
                'store' => new ProductResourceCollection($store)
            ],
            'status' => 'success'
        ],200);
    }
}
