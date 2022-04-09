<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  


    public function index(){

        return view('signup');
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);
        
        // dd($request->only('email'));
        // if(Auth::attempt([$request->get('email'), Hash::make($request->get('password'))] )){
        //     $request->session()->regenerate();
        //     return redirect()->route('/dashboard');
        // }

        User::create([
            'fname'=> $request->get('fname'),
            'lname'=> $request->get('lname'),
            'email'=> $request->get('email'),
            'password'=> Hash::make($request->get('password')),
        ]);

        Auth::attempt([
            'email'=> $request->get('email'),
            'password'=> $request->get('password')
        ]);
    
        return redirect()->route('dashboard');
    }

}
