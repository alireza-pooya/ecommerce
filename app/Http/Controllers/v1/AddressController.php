<?php

namespace App\Http\Controllers\v1;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('home.dashboard.address.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.dashboard.address.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'country'        => ['required'],
            'city'           => ['required'],
            'street'         => ['required'],
            'zip_code'       => ['required'],
            'phone_number'   => ['required','numeric'],
        ]);
        Address::create([
            'user_id'       => Auth::id(),
            'country'       => $request['country'],
            'city'          => $request['city'],
            'street'        => $request['street'],
            'zip_code'      => $request['zip_code'],
            'phone_number'  => $request['phone_number'],
        ]);

        $message = "your address created successfully";
        return redirect( route('address.index'))->with('message',$message);
    }

    /**
     * @param Address $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Address $address)
    {
        return  view('home.dashboard.address.edit',compact('address'));
    }

    /**
     * @param Request $request
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Address $address)
    {
        $this->validate($request,[
            'country'        => ['required'],
            'city'           => ['required'],
            'street'         => ['required'],
            'zip_code'       => ['required'],
            'phone_number'   => ['required','numeric'],
        ]);

        $address->update([
            'country'       => $request['country'],
            'city'          => $request['city'],
            'street'        => $request['street'],
            'zip_code'      => $request['zip_code'],
            'phone_number'  => $request['phone_number'],
        ]);

        $message = "your address edited successfully";
        return redirect( route('address.index'))->with('message',$message);
    }


    /**
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Address $address)
    {
        $address->delete();

        $message = "your address deleted successfully";
        return redirect( route('address.index'))->with('message',$message);
    }
}
