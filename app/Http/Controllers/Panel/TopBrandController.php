<?php

namespace App\Http\Controllers\Panel;

use App\Classes\custom;
use App\TopBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topBrands = TopBrand::all();

        return view('panel.topbrand.index', compact('topBrands'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'link'        => 'required',
            'image'       => 'required | mimes:png,jpeg,jpg,bmp',
        ]);

        $file= null;
        if ($request['image']) {
            $file = Custom::uploader($request['image'], "upload/TopBrand/");
        }
        TopBrand::create([
            'link'  => $request->link,
            'image' => $file,
        ]);

        $message = "your Brand created successfully";
        return redirect()->back()->with('message',$message);

    }

    /**
     * @param Request $request
     * @param TopBrand $topBrand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request , TopBrand $topBrand)
    {
        if($request->selected){
            TopBrand::destroy($request->selected);
            $message = "your Brand deleted successfully";
            return redirect()->back()->with('message',$message);
        }
        return redirect()->back();
    }
}
