<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("admin");

    }

    public function index(){
        foreach(Status::all() as $status) {
            var_dump($status);
        }
        return view('statuses');
    }

    public function create(Request $request){
        // $this->validate($request, [
        //     'service' => ,
        // ]);

        Status::create([
            "status" => $request->status
        ]);
        return view('dashboard');
    } 

    public function store(){

    } 

    public function destroy(){

    }   
}
