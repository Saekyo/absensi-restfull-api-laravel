<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modeks\Media;
use App\Http\Request\MediaStoreRequest;

class MediaController extends Controller
{
    // View File To Upload Image
    public function index()
    {
        return view('image-form');
    }

    // Store Image
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);


        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('images'), $imageName);

        // //Store in Storage Folder
        // $request->image->storeAs('images', $imageName);

        // // Store in S3
        // $request->image->storeAs('images', $imageName, 's3');

        //Store IMage in DB 

        $url = str_replace("http://127.0.0.1:8000/", "http://127.0.0.1:8000/images/", url($imageName));

        return response()->json([
            'status' => 'success',
            'data' => $url
            ]);
        }
    
    
}
