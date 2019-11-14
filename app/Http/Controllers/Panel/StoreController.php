<?php

namespace App\Http\Controllers\Panel;

use App\Product;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request , Product $product)
    {

        $all = Store::where('product_id',$product->id)->orderBy('id', 'desc')->with('product');

        if ($request->search) {
            $all = $all->where('color', 'LIKE', '%' . $request->search . '%')
                ->OrWhere('size', 'LIKE', '%' . $request->search . '%');
        }

        $stores = $all->paginate(10)->appends($request->query());
        return view('panel.store.index', compact('stores', 'product'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request , Product $product)
    {
        $this->validate($request, [
            'color'      => 'required',
            'size'       => 'required' ,
            'quantity'   => 'required | numeric' ,
        ]);
        Store::create([
            'color'      => $request['color'],
            'size'       => $request['size'] ,
            'quantity'   => $request['quantity'] ,
            'product_id' => $product->id,
        ]);
        $message = "your stores added to product successfully";
        return redirect()->back()->with('message', $message);
    }

    /**
     * @param Store $store
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Store $store)
    {
        $store->delete();
        $message = "your stores deleted successfully";
        return redirect()->back()->with('message', $message);
    }

}
