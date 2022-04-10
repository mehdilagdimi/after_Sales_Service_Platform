<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['admin'])->only(['destroy']);
    }

    public function index(){

    }

    public function create(){

    }

    public function store(){

    }

    public function destroy(){
        var_dump(Auth::user()->role);
        dd('test admin nmiddleware');
    }

}
