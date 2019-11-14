<?php

namespace App\Http\Controllers\v1;

use App\Product;
use App\Store;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
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
        }

        $totalPrice = Cart::instance('cart')->subtotal(0);

        $user = User::whereId($user_id)->with('addresses')->first();

        return view('home.cart', compact('user', 'totalPrice','stores'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addToCart(Request $request, Product $product)
    {
        $this->validate($request,[
            'color'     => 'required',
            'size'      =>  'required',
            'quantity'  =>  'required',
        ]);

        $user = Auth::id();

        Cart::instance('cart');
        Cart::instance('cart')->add(['id' => $product->id, 'name' => $product->name, 'qty' => $request->quantity, 'price' => $product->new_price, 'options' => ['user_id' => $user , 'store_id' => $request->size]]);

        $message = $product['name'] . " added successfully to cart";
        return redirect()->back()->with('message', $message);

    }

    /**
     * @param Store $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Store $store)
    {
        $id = Cart::instance('cart')->content();
        foreach ($id as $cart) {
            if ($cart->options->store_id == $store->id){
                Cart::instance('cart')->remove($cart->rowId);
                return redirect()->back();
            }
        }
    }
}
