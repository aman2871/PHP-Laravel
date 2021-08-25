<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $uid = Auth::user()->id;

        $image = Image::where('users_id', $uid)->get();
        // foreach
        // return dd($image[0]->images);
        // $picture=json_decode($image->);


        return view('home', compact('image'));
    }
}
