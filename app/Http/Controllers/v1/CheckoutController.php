<?php

namespace App\Http\Controllers\v1;

use App\Discount;
use App\Order;
use App\OrderItem;
use App\Store;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout(Request $request)
    {
        $user_id = Auth::id();
        $user = User::whereId($user_id)->with('addresses')->first();
        $discountCode = $request->discountCode;

        return view('home.checkout', compact('user', 'discountCode'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function goBank(Request $request)
    {
        $user_id = Auth::id();

        $id = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($user_id) {
            return $cartItem->options->user_id === $user_id;
        });

        $store_qts = array();
        $store_ids = array();
        foreach ($id as $store) {
            $store_ids[$store->options->store_id] = $store->options->store_id;
            $store_qts[$store->options->store_id] = $store->qty;
        }
        $stores = Store::whereIn('id', $store_ids)->with('product')->get();

        $totalPrice = Cart::instance('cart')->subtotal(0);

        if ($request->discountCode) {
            $discount = Discount::where('code', $request->discountCode)
                ->where('number', '>', 0)
                ->where('start_date', '<', now())
                ->where('expire_date', '>', now())
                ->first();
            if (is_null($discount)) {
                $FinalPrice = $totalPrice;
                $discount_id = null;
            }else {
                $FinalPrice = str_replace(",", "", $totalPrice);
                $FinalPrice = $FinalPrice - (($discount->value / 100) * $FinalPrice);
                $discount_id = $discount->id;

                if (auth()->user()->orders()->where('status',1)->where('discount_id',$discount_id)->exists()){
                    $message = "you bought before with this code";
                    return redirect(route('cart'))->with('message', $message);
                }
            }
        } else {
            $discount_id = null;
            $FinalPrice = $totalPrice;
        }


        $order =  Order::create([
            'user_id'       =>  $user_id,
            'discount_id'   =>  $discount_id,
            'address_id'    =>  $request->address,
            'pay_time'      =>  now(),
            'total_price'   =>  $FinalPrice,
            'status'        =>  2,
        ]);

        foreach ($stores as $store) {
            if (isset($store_ids[$store->id])) {
                $store['qt'] = $store_qts[$store->id];
                $store['totalEachProduct'] = $store['qt'] * $store->product->new_price;

                if ($store->qt > $store->quantity) {
                    $message = $store->product->name . " size = " . $store->size . " doesn't have enough quantity, please choose again";
                    return redirect(route('cart'))->with('message', $message);
                }
               OrderItem::create([
                    'user_id'     => $user_id,
                    'product_id'  => $store->product_id,
                    'order_id'    => $order->id,
                    'color'       => $store->color,
                    'size'        => $store->size,
                    'number'      => $store->qt,
                    'price'       => $store->product->new_price,
               ]);

            }
        }
        $order_id = $order->id;

        return view('home.goBank',compact('discount_id','order_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function returnBank(Request $request)
    {
        if($request->bank == 1){
            if (! is_null($request->discount)) {
                $discount = Discount::whereId($request->discount)->first();
                $count = $discount->number - 1;
                $discount->update([
                    'number' => $count,
                ]);
            }

            $order = Order::whereId($request->order)->first();
            $order->update([
                'status'  =>  $request->bank,
            ]);

            $user_id = Auth::id();

            $id = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($user_id) {
                return $cartItem->options->user_id === $user_id;
            });

            $store_qts = array();
            $store_ids = array();
            foreach ($id as $store){
                $store_ids[$store->options->store_id] = $store->options->store_id;
                $store_qts[$store->options->store_id] = $store->qty;
            }
            $stores = Store::whereIn('id', $store_ids)->with('product')->get();

            foreach ($stores as $store) {
                if(isset($store_ids[$store->id])){
                    $store['qt'] = $store_qts[$store->id];
                    $store['totalEachProduct'] = $store['qt'] * $store->product->new_price;
                }
                    $quantity = $store->quantity - $store->qt;
                    $ThisStore = Store::where('id', $store->id)->first();
                    $ThisStore->update([
                        'quantity' => $quantity,
                    ]);
            }
            Cart::instance('cart')->destroy();
        }

        $bank = $request->bank;

        return view('home.backFromBank',compact('bank'));
    }
}
