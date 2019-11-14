<?php

namespace App\Http\Controllers\Panel;

use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all = Discount::orderBy('id', 'desc');

        if ($request->search) {
            $all = $all->where('code', 'LIKE', '%' . $request->search . '%');
        }

        $discounts = $all->paginate(20)->appends($request->query());
        return view('panel.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.discount.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code'          => ['required', 'unique:discounts'],
            'value'         => ['required','numeric'],
            'start_date'    => ['required'],
            'expire_date'   => ['required'],
            'number'        => ['numeric'],
        ]);

        Discount::create([
            'code'          => $request['code'],
            'value'         => $request['value'],
            'start_date'    => $request['start_date'],
            'expire_date'   => $request['expire_date'],
            'number'        => $request['number'],
        ]);

        $message = "your discount code created successfully";
        return redirect(route('discount.index'))->with('message', $message);
    }

    /**
     * @param Discount $discount
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Discount $discount)
    {
        return view('panel.discount.edit', compact('discount'));
    }

    /**
     * @param Request $request
     * @param Discount $discount
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Discount $discount)
    {
        $this->validate($request, [
            'code'          => ['required'],
            'value'         => ['required','numeric'],
            'start_date'    => ['required'],
            'expire_date'   => ['required'],
            'number'        => ['numeric'],
        ]);

        $discount->update([
            'code'          => $request['code'],
            'value'         => $request['value'],
            'start_date'    => $request['start_date'],
            'expire_date'   => $request['expire_date'],
            'number'        => $request['number'],
        ]);

        $message = "your discount code edited successfully";
        return redirect(route('discount.index'))->with('message', $message);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if ($request->selected) {
            Discount::destroy($request->selected);
            $message = 'your discount code deleted successfully';
            return redirect()->back()->with('message', $message);
        }
        return redirect()->back();
    }
}
