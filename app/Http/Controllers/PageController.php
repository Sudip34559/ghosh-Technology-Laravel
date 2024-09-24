<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Models\Gallerie;
use App\Models\SliderImage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $headers = Header::all();
        $images = SliderImage::take(3)->get();
        return view('pages.home', compact('headers', 'images'));
    }
    public function about(){
        $headers = Header::all();
        return view('pages.about', compact('headers'));
    }

    public function contact(){
        $headers = Header::all();
        return view('pages.contuct', compact('headers'));
    }
    public function service(){
        $headers = Header::all();
        return view('pages.service', compact('headers'));
    }
    public function imageGalary(){
        $galleries = Gallerie::all();
        // Add public path to each image in galleries
    // Add public path to each image in galleries
    $galleries = $galleries->map(function($gallery) {
        $gallery->imagepath = asset('storage/' . $gallery->image);
        return $gallery;
    });
    // dd($galleries);
        $headers = Header::all();
        return view('pages.imageGelary', compact('headers', 'galleries'));
    }


}
