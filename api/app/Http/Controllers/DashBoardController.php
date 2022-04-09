<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashBoardController extends Controller
{
    public function index()
    {
        // dd(auth()->user());
        // dd(Auth::user());
        return view('pages.dashboard');
    }
}
