<?php

namespace App\Http\Controllers;

use App\Models\ContuctUs;
use Illuminate\Http\Request;

class ContuctUsController extends Controller
{
    public function index(){
        // Retrieve all contact us messages
        $contact_us = ContuctUs::all();
        return view('admin.content.contuctUs', compact('contact_us'));
    }
    public function store(Request $request){
        // Validate the request data
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        // Create a new contact us message
        $contact = ContuctUs::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        // Redirect to the contact us page with a success message
        return back()->with('success', 'Your message has been sent successfully.');
    }
    public function destroy($id){
        // Find the contact us message by ID
        $contact = ContuctUs::find($id);
        // Delete the contact us message
        $contact->delete();
        // Redirect to the contact us page with a success message
        return back()->with('success', 'Your message has been deleted successfully.');
    }
}
