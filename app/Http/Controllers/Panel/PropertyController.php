<?php

namespace App\Http\Controllers\Panel;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = Property::orderBy('id');

        if ($request->search) {
            $all = $all->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $properties = $all->paginate(20)->appends($request->query());
        return view('panel.property.index', compact('properties'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:properties']
        ]);

        Property::create([
            'name' => $request['name'],
        ]);

        $message = $request->name . " property created successfully";
        return redirect()->back()->with('message', $message);
    }

    /**
     * @param Property $property
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Property $property)
    {
        return view('panel.property.edit' , compact('property'));
    }

    /**
     * @param Request $request
     * @param Property $property
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Property $property)
    {
        $this->validate($request,[
            'name' => ['required', 'unique:properties']
        ]);

        $property->update([
            'name' => $request['name'],
        ]);

        $message = 'property name changed to ' . $request->name ;
        return redirect(route('property.index'))->with('message',$message);
    }

}
