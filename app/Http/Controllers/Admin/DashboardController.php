<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::first();
        return view('admin.dashboard', compact('contact'));
    }

    public function socialMedia(Request $request)
    {
        $contact = Contact::first();
        $contact->update($request->only('ig', 'wa', 'wa_subject', 'email', 'email_subject'));
        return redirect()->back()->with('success', 'Contact updated successfully');
    }
}
