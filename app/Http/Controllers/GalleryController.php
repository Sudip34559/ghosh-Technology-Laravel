<?php

namespace App\Http\Controllers;

use App\Models\Gallerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function create(){
        $gallery = Gallerie::all();
        return view('admin.content.imageUploade', compact('gallery'));
    }
    public function upload(Request $request){
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->extension();
            $path = $request->file('image')->storeAs('uploads/gallery_images', $fileName, 'public');
            // dd($path);
            Gallerie::create([
                'image' => $path,  // Get the file name after storing it in the storage folder
            ]);
            return back()->with('success', 'Image uploaded successfully!')->with('image', $path);
        }

        return back()->with('error', 'Image upload failed!');
    }

    public function deleteImage($id)
    {
        $image = Gallerie::find($id);
        if ($image) {
            // Delete the image file from storage
            Storage::delete('public/' . $image->image);
            
            // Delete the record from the database
            $image->delete();
    
            return back()->with('success', 'Image deleted successfully');
        }
        return back()->with('error', 'Image not found');
     }
}
