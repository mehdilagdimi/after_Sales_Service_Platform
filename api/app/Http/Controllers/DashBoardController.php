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
        // return view('pages.dashboard');
        return redirect()->route('showTickets');
    }

    public function adminBoard(){
        return redirect()->route('showAdminBoard');
    }
}
