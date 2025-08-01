<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function ContactPage()
    {
        return view('contact');
    }

    public function ContactStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|email|max:100',
            'message' => 'required'
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->to('/contact')->with('success', 'Message sent successfully!');
    }
}
