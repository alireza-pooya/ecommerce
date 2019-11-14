<?php

namespace App\Http\Controllers\api;

use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculateDiscountController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function discount(Request $request)
    {
        $discount = Discount::where('code',$request->discountCode)
            ->where('number', '>', 0)
            ->where('start_date', '<', now())
            ->where('expire_date', '>', now())
            ->first();

        if($discount) {
            return response([
                'data' => [
                    'percentage' => $discount->value
                ],
                'status' => 'success'
            ], 200);
        }else{
            return response([
                'data' => [
                    'percentage' => 0
                ],
                'status' => 'success'
            ],200);
        }
    }
}
