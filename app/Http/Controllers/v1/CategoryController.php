<?php

namespace App\Http\Controllers\v1;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @param $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search($category)
    {
        $productions = Product::wherehas('categories',function ($query) use ($category){
            $query->where('id',$category);
        })->paginate(20);

        return view('home.search',compact('productions'));
    }
}
