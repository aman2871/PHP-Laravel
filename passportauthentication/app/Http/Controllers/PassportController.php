<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class PassportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function alluser(Request $request)
    {
        $user = User::all();
        return response()->json(['user' => $user], 200);
    }
    // index functions
    public function logindex()
    {
        return view('login');
    }
    public function regindex()
    {
        return view('register');
    }
    public function index()
    {
        $uid = Auth::user()->id;
        $image = Image::where('users_id', $uid)->get();

        return view('home', compact('image'));
    }

    // functions used for storing data
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'errors' => [
                    'email' => ['could not sign you in with those credentials']
                ]
            ], 422);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return redirect('home');
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'image' => ['required', ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]]
        ]);
        // $img = $request->image->store('images', 'public');
        // dd($img);
        // exit;

        $users = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            // 'image' => $img
        ]);
        if (!$users) {
            return response()->json(['success' => false, 'message' => 'Registration failed']);
        }
        return redirect('login');
    }


    public function imgupload(Request $request)
    {
        $img = $request->image->store('images', 'public');
        $uid = Auth::user()->id;
        Image::create([
            'image' => $img,
            'users_id' => $uid
        ]);
        return back();
    }

    public function imgedit(Request $req)
    {
        // using eloquent update
        $id = Auth::user()->id;
        $response = User::where('id', $id)->update(['name' => $req->name]);
        if ($response) {
            $image = $req->image->store('images', 'public');
            Image::where('users_id', $id)->update(['image'=> $image]);
            return redirect()->back();
        }

        // without using eloquent update

        // $image = Image::find($req->id);        
        // $image->image = $req->image->store('images', 'public');
        // $image->save();

        // $user=User::find($req->id);
        // $user->name=$req->name;
        // $user->save(); 
    }


    public function logout(Request $request)
    {

        $request->user()->token()->delete();
        return response()->json([
            'message' => 'Logout successfull'
        ]);
    }
}
