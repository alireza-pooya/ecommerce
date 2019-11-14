<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\SendWelcomeMailNotification;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function registerStore(Request $request)
    {
        $this->validate($request ,[
            'full_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender'     => ['required'],
            'password'   => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user =  User::create([
            'full_name'     => $request['full_name'],
            'email'         => $request['email'],
            'gender'        => $request['gender'],
            'password'      => bcrypt($request['password']),
        ]);

        $user->notify(new SendWelcomeMailNotification());
        $message = "your account created successfully";
        return redirect(route('login'))->with('message',$message);
    }

}
