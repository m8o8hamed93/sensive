<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:contacts,email',
            'subject' => 'required|min:4',
            'message' => 'required',
        ]);
        Contact::create($data);
        return back()->with('status', 'Message Sent Successfully');
    }
}
