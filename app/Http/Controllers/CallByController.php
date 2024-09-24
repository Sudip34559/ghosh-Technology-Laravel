<?php

namespace App\Http\Controllers;

use App\Models\CallBy;
use Illuminate\Http\Request;

class CallByController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'call_by' =>'required|string|max:255'
        ]);
        CallBy::create([
            'call_by' => $request->call_by,
        ]);
        return back()->with('success', 'Call By added successfully');
    }
}
