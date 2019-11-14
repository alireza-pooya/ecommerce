<?php

namespace App\Http\Controllers\v1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('home.dashboard.dashboardwelcome', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('home.dashboard.profile.edit', compact('user'));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'full_name'      => ['required', 'string', 'max:255'],
            'email'          =>'required', 'string', 'email', 'max:255', 'unique:users'.$user->id,
            'gender'         => ['required'],
            'mobile'         => ['numeric'],
        ]);

        $user->update([
            'full_name'      => $request['full_name'],
            'image'          => $request['image'],
            'email'          => $request['email'],
            'gender'         => $request['gender'],
            'mobile'         => $request['mobile'],
        ]);

        $message = "your profile updated successfully";
        return redirect(route('dashboard.index'))->with('message', $message);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        $user = Auth::user();
        return view('home.dashboard.password.password', compact('user'));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(User $user, Request $request)
    {
        $this->validate($request,[
            'password'   => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user->update([
            'password'   => bcrypt($request['password'])
        ]);

        $message = "your password updated successfully";
        return redirect(route('dashboard.index'))->with('message', $message);
    }
}
