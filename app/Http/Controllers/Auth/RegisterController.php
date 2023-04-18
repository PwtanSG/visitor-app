<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|max:50',
            'email'=>'required|email|max:255',
            'password'=>'required|confirmed|max:50'
        ]);

        //Eloquent -> dB
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email','password'));

        //redirect
        return redirect()->route('visitor');
        //return redirect('/posts');        
        //dd($request);
        //return '123';
    }
}