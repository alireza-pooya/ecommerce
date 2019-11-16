<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\PasswordResets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getemail()
    {
        return view('auth.passwords.getemail');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendlink(Request $request)
    {
        $this->validate($request, [
            'email' => 'required | email | exists:users'
        ]);

        $user = User::whereEmail($request['email'])->first();

        $passwordReset = PasswordResets::create([
            'email'       =>   $request['email'],
            'token'       =>   Str::random(60),
            'created_at'  =>   now()
        ]);

        $link = url("checktoken?token={$passwordReset['token']}");

        Mail::to($passwordReset['email'])->send(new ResetPasswordMail($user,$link));

        $message = "recovery password link sent for you please check that";
        return redirect('/')->with('message',$message);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checktoken(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        if ($reset = PasswordResets::whereToken($request['token'])->where('created_at','>',now()->subDay())->first())
        {
            if ($user = User::whereEmail($reset['email'])->first())
            {
                $token = $request['token'];
                return view('auth.passwords.reset' , compact('token'));
            }
            return redirect(url('/'));
        }
        return redirect(url('/'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function setnewpassword(Request $request)
    {
        $this->validate($request, [
            'token'     => 'required',
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($reset = PasswordResets::whereToken($request['token'])->where('created_at','>',now()->subDay())->first())
        {
            if ($user = User::whereEmail($reset['email'])->first())
            {
                $user->update([
                    'password' => bcrypt($request['password']),
                ]);

                $message= 'your password changed edited successfully';
                return redirect(url('/login'));
            }
            $message="not found user";
            return redirect()->back()->with('message' , $message);
        }
        $message="this link expired";
        return redirect()->back()->with('message' , $message);
    }
}
