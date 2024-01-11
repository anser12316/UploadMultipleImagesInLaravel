<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(){
        return view('upload-image');
    }

    public function store(Request $request){
        $request->validate([
            'images.*' => 'required|mimes:png,jpg,gif,jpeg,bmp|max:2048'
        ]);
        
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image)
            {
                $modifiedImage = time(). '-'. $image->getClientOriginalName();
                $image->move(public_path('/images'), $modifiedImage);

                Image::create([
                    'name' => $modifiedImage,
                ]);
            }
        }

        
        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }
}


  //     if($request->images){
    //         foreach ($request->images as image)
    //         {
    //             $modifiedImage = time(). '-'. $image->getClientOriginalName();
    //             $image->move(public_path('/images'),$modifiedImage);
    //         }
    //     }

    // }