<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('imageupload');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function imgstore(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'image'
        ]);

        $files = [];
        if ($request->hasfile('image')) {
            foreach ($request->image as $file) {
                
                $img = $file->store('images', 'public');
                
                Image::create([
                    'images' => $img,
                    'users_id' => Auth::user()->id
                ]);
            }
        }

        return back()->with('success', 'Data Your files has been successfully added');
    }
}
