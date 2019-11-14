<?php

namespace App\Http\Controllers\v1;

use App\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orders()
    {
        $user_id = Auth::id();
        $orders = OrderItem::where('user_id',$user_id)->with('product')->get();

        return view('home.dashboard.orders.orders',compact('orders'));
    }
}
