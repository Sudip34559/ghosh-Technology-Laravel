<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Models\TextSlider;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Show the form for creating a new header.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headers = Header::all();
        return view('admin.content.addHeader', compact('headers')); // Load the form view
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'main_header' => 'required|string|max:255',
            'sub_header_count' => 'required|integer|min:1',
            'sub_header_name.*' => 'required|string|max:255',
            'sub_header_link.*' => 'required|url',
        ]);

        $existingHeader = Header::where('header', '=', $request->main_header)->first();
        if ($existingHeader) {
            return back()->with('error', 'A header with this name already exists.');
        }

        // Prepare the subheader array
        $subheaders = [];
        for ($i = 0; $i < $request->sub_header_count; $i++) {
            $subheaders[$request->sub_header_name[$i]] = $request->sub_header_link[$i];
        }
        // dd($subheaders);  // Uncomment to debug the subheader array
        // Create a new Header
        Header::create([
            'header' => $request->main_header,
            'subheader' => $subheaders,
        ]);

        // Redirect to a page with a success message
        return back()->with('success', 'Header created successfully.');
    }

    public function index()
    {
        $headers = Header::all();
        return view('pages.home', compact('headers'));
    }
    
     public function destroy($id) {
         $header = Header::find($id);
         $header->delete();
         return back()->with('success', 'Header deleted successfully.');
     }

     public function addSlide(){
        return view('admin.content.addTextSlide');
    }
     
     public function addText(Request $request) {
         $request->validate([
            'slidText1' =>'required|string|max:255',
            'slidText2' => 'nullable|string|max:255',
            'slidText3' => 'nullable|string|max:255',
            'slidText4' => 'nullable|string|max:255',
         ],[
            'slidText1.required' => 'The first slide text is required.',
            'slidText1.string' => 'The first slide text must be a string.',
            'slidText1.max' => 'The first slide text must not exceed 255 characters.',
         ]);
         $slidText = [
             $request->slidText1,
             $request->slidText2?? null,
             $request->slidText3?? null,
             $request->slidText4?? null,
         ];
         TextSlider::truncate();  // Clear any existing text slider data

        // Loop through the array and insert non-null text
foreach ($slidText as $text) {
    if ($text !== null) {  // Check for non-null values
        TextSlider::create([
            'slidText' => $text,
        ]);
    }
}
         
          
         return back()->with('success', 'Text slider updated successfully.');
     }

     public function showText() {
         $textSlider = TextSlider::all();
         return response()->json($textSlider);
     }
     public function deleteText() {
          TextSlider::truncate();;
         return back()->with('success', 'Text slider deleted successfully.');
     }


}
