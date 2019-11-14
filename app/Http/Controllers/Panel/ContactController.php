<?php

namespace App\Http\Controllers\Panel;

use App\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $all = Contact::orderBy('id', 'desc');

        if ($request->search) {
            $all = $all->where('full_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('content', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%');
        }

        $contacts = $all->paginate(20)->appends($request->query());
        return view('panel.contact.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('panel.contact.show', compact('contact'));
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Contact $contact)
    {

        $this->validate($request, [
            'response' => 'required',
        ]);

        $contact->update([
            'response' => $request['response'],
        ]);

        Mail::to($contact->email)->send(new ContactMail($contact));

        $message = "your response sent successfully";
        return redirect(route('contact.index'))->with('message', $message);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if ($request->selected) {
            Contact::destroy($request->selected);
            $message = 'your contact deleted successfully';
            return redirect()->back()->with('message', $message);
        }
        return redirect()->back();
    }
}
