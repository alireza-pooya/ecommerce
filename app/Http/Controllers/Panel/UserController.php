<?php

namespace App\Http\Controllers\Panel;

use App\Order;
use App\OrderItem;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = User::OrderBy('id');
        if ($request->search) {
            $all = $all->where('id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('full_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $request->search . '%');
        }

        $users = $all->paginate(20)->appends($request->query());
        return view('panel.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('panel.user.edit',compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'full_name'  => [ 'string', 'max:255'],
            'email'      =>  'email', 'max:255', 'unique:users'.$user->id,
            'password'   => ['confirmed'],
            'mobile'     => ['numeric'],
        ]);

        $user->update([
            'full_name'      => $request['full_name'],
            'email'          => $request['email'],
            'gender'         => $request['gender'],
            'mobile'         => $request['mobile'],
            'password'       => bcrypt($request['password']),
        ]);

        $message = "your profile updated successfully";
        return redirect(route('user.index'))->with('message', $message);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user){

        return view('panel.user.order',compact('user'));

    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orders(Order $order)
    {
        $orderItems = OrderItem::where('order_id',$order->id)->get();
        return view('panel.user.show',compact('orderItems'));
    }
}
