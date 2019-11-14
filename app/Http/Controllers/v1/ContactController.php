<?php

namespace App\Http\Controllers\v1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home.contact');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => ['required'],
            'email' => ['required', 'email'],
            'body'  => ['required'],
        ]);

        Contact::create([
            'full_name'      => $request['name'],
            'email'          => $request['email'],
            'mobile'         => $request['mobile'],
            'content'        => $request['body'],
        ]);

        $message = "your message successfully sent";
        return redirect()->back()->with('message', $message);
    }
}
