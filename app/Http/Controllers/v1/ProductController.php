<?php

namespace App\Http\Controllers\v1;

use App\Comment;
use App\Gallery;
use App\Product;
use App\Store;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Product $product)
    {
        $comments = Comment::where('approved',1)->where('product_id',$product->id)->orderBy('id','desc')->with('user','product')->paginate(2);
        $galleries = Gallery::where('product_id',$product->id)->pluck('img');
        $stores = Store::where('product_id',$product->id)->get()->groupBy('color');

        foreach ($product->categories as $category){
            $pro = $category->id;
        }

        $productions = Product::wherehas('categories',function ($query) use ($pro){
            $query->where('id',$pro);
        })->get();

        $productRating = Comment::where('product_id',$product->id)->get();

        $count = 0;
        $totalRate = 0;
        if(count($productRating)){
            foreach ($productRating as $item) {
                $count += 1 ;
                $totalRate += $item->rating;
            }
            $totalRate = $totalRate / $count;
            $rate = ceil($totalRate);
        }else{
            $rate = 0;
        }
        return view('home.product',compact('stores','galleries','comments','product' ,'productions','rate','count'));
    }
}
