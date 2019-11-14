<?php

namespace App\Http\Controllers\Panel;

use App\Brand;
use App\Category;
use App\Classes\Custom;
use App\Gallery;
use App\Product;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = Product::orderBy('id', 'desc')->with('brand');

        /// filter status
        if ($request->status)
            $all = $all->where('status',$request->status);

        ///search
        if ($request->search) {
            $all = $all->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('old_price', 'LIKE', '%' . $request->search . '%')
                ->orWhere('new_price', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $products = $all->paginate(20)->appends($request->query());

        return view('panel.product.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $brands = Brand::all();
        $properties = Property::all();
        $categories = Category::whereNotNull('parent_id')->get();
        return view('panel.product.create',compact('brands','categories','properties'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request ,[
            'name'           => ['required','unique:products'],
            'brand'          => ['required'],
            'category'       => ['required'],
            'old_price'      => ['required','numeric'],
            'new_price'      => ['required','numeric'],
            'img'            => ['required'],
            'description'    => ['required'],
            'gallery'        => ['required'],
        ]);

        $file= null;
        if ($request['img']) {
            $file = Custom::uploader($request['img'], "upload/{$request['name']}/poster/");
        }

        $product = Product::create([
            'name'          => $request['name'],
            'brand_id'      => $request['brand'],
            'old_price'     => $request['old_price'],
            'new_price'     => $request['new_price'],
            'status'        => $request['status'],
            'description'   => $request['description'],
            'img'           => $file,
        ]);

        if($request['gallery']){
            foreach ($request['gallery'] as $file){
                $product->galleries()->create([
                'img'            => Custom::uploader($file, "upload/{$request['name']}/gallery/"),
                'product_id'     => $product->id,
                ]);
            }
        }

        if($request['category']){
                $product->categories()->sync($request['category']);
        }

        $message = "your product created successfully , add properties to"."{$product->name}";
        return redirect(route('product.property.index',['product'=>$product->slug]))->with('message',$message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::whereNotNull('parent_id')->get();
        return view('panel.product.edit',compact('product','brands','categories'));
    }


    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request ,[
            'name'      => 'required','unique:products'.$product->id,
            'brand'     => ['required'],
            'category'  => ['required'],
            'old_price' => ['required','numeric'],
            'new_price' => ['required','numeric'],
        ]);
        $file = $product->img;
        if ($request['img']) {
            $file = Custom::uploader($request['img'], "upload/{$request['name']}/poster/");
        }

        $product->update([
            'name'          => $request['name'],
            'brand_id'      => $request['brand'],
            'old_price'     => $request['old_price'],
            'new_price'     => $request['new_price'],
            'status'        => $request['status'],
            'description'   => $request['description'],
            'img'           => $file,
        ]);

        if($request['gallery']){
            foreach ($request['gallery'] as $file){
                $product->galleries()->create([
                    'img'            => Custom::uploader($file, "upload/{$request['name']}/gallery/"),
                    'product_id'     => $product->id,
                ]);
            }
        }

        if($request['category']){
            $product->categories()->sync($request['category']);
        }

        $message = "your product updated successfully";
        return redirect(route('product.index'))->with('message',$message);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request , Product $product)
    {
        if($request->selected) {
            Gallery::destroy($request->selected);
            $message = "pictures deleted successfully from gallery";
            return redirect()->back()->with('message',$message);
        }
        return redirect()->back();
    }
}
