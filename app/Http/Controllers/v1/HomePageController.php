<?php

namespace App\Http\Controllers\v1;

use App\Category;
use App\Product;
use App\SlideShow;
use App\TopBrand;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = Product::orderBy('id', 'desc')->where('status', 1)->with('brand');

        /// filter status
        if ($request->status)
            $all = $all->where('status',$request->status);

        ///search
        if ($request->search) {
            $all = $all->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('old_price', 'LIKE', '%' . $request->search . '%')
                ->orWhere('new_price', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('brand', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $products = $all->paginate(10)->appends($request->query());
        $topBrands = TopBrand::all();
        $slideshows = SlideShow::where('start_show', '<', now())->where('end_show', '>', now())->get();

        return view('home.home', compact('products', 'slideshows','topBrands'));
    }
}
