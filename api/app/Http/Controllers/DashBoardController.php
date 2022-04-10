<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['index']);
    } 
    
    public function index()
    {
        // dd(auth()->user()->password);
        // dd(Auth::user());
        return view('pages.dashboard');
    }
}
