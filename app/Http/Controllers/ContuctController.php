<?php

namespace App\Http\Controllers;

use App\Models\Contuct;
use App\Models\ContuctUs;
use Illuminate\Http\Request;

class ContuctController extends Controller
{
    public function index(){
        // Retrieve all contact us messages
        $contacts = Contuct::all();
        return view('admin.content.contuct', compact('contacts'));
    }
    public function store(Request $request){
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        // Create a new contact us message
        $contact = Contuct::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
        // Redirect to the contact us page with a success message
        return back()->with('success', 'Your message has been sent successfully.');
    }
    public function destroy($id){
        // Find the contact us message by ID
        $contact = Contuct::find($id);
        // Delete the contact us message
        $contact->delete();
        // Redirect to the contact us page with a success message
        return back()->with('success', 'Your message has been deleted successfully.');
    }
}
