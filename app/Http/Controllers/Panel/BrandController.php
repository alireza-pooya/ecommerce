<?php

namespace App\Http\Controllers\Panel;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function index(Request $request)
    {
        $all = Brand::orderBy('id');

        if ($request->search) {
            $all = $all->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $brands = $all->paginate(20)->appends($request->query());
        return view('panel.brand.index', compact('brands'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate(Request(), [
            'name' => ['required', 'unique:brands']
        ]);

        Brand::create([
            'name' => $request['name'],
        ]);

        $message = $request->name . ' brand successfully added ';
        return redirect()->back()->with('message', $message);
    }

    /**
     * @param Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        return view('panel.brand.edit', compact('brand'));
    }

    /**
     * @param Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate(Request(), [
            'name' => ['required', 'unique:brands']
        ]);

        $brand->update([
            'name' => $request['name'],
        ]);

        $message = 'brand name changed to ' . $request->name ;
        return redirect(route('brand.index'))->with('message',$message);
    }

}
