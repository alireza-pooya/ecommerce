<?php

namespace App\Http\Controllers\Panel;

use App\Address;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $all = Order::orderBy('id')->with('discount', 'user', 'orderItems');

        /// filter status
        if ($request->status)
            $all = $all->where('status',$request->status);

        ///search
        if ($request->search) {
            $all = $all->where('total_price', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                ->orWhere('bank', 'LIKE', '%' . $request->search . '%')
                ->orWhere('ref_id', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('email', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('discount', function ($query) use ($request) {
                    $query->where('code', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('orderItems', function ($query) use ($request) {
                    $query->where('price', 'LIKE', '%' . $request->search . '%');
                });
        }

        $purchases = $all->paginate(20)->appends($request->query());

        return view('panel.purchase.index', compact('purchases'));
    }

    /**
     * @param $purchase
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($purchase)
    {
        $purchase = Order::whereId($purchase)->with('discount', 'user', 'orderItems')->first();
        $address = Address::whereId($purchase->address_id)->first();
        return view('panel.purchase.show', compact('purchase','address'));
    }
}
