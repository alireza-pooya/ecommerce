<?php

namespace App\Http\Controllers\Panel;

use App\Product;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductPropertyController extends Controller
{

    public function index(Product $product, Request $request)
    {
        $all = Property::orderBy('id', 'desc')->with('products');

        if ($request->search) {
            $all = $all->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $properties = $all->paginate(20)->appends($request->query());
        return view('panel.productProperty.index', compact('properties', 'product'));
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Product $product, Request $request)
    {

        $this->validate($request, [
            'value' => 'required',
            'property_id' => 'required'
        ]);

        if ($product->properties()->where('id',$request['property_id'])->exists()){
            $message = "your property added before";
            return redirect()->back()->with('message', $message);
        }

        $product->properties()->attach($request['property_id'], [
                'value' => $request['value']]);

        $message = "your property added to product successfully";
        return redirect()->back()->with('message', $message);

    }

    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product, Request $request)
    {
        if ($request->selected) {
            $product->properties()->detach($request->selected);
            $message = 'your property code deleted successfully';
            return redirect()->back()->with('message', $message);
        }
        return redirect()->back();
    }
}
