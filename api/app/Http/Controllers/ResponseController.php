<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("admin");
    }

    public function index(Request $request)
    {
        foreach (Response::all() as $response) {
            var_dump($response);
        }
        $responses = Ticket::find(1)->responses()
                         ->where('id', $request->ticket_id);
        return view('dashboard', ['responses' => $responses]);
    }

    public function create(Request $request){
        //session
        return back()->with('addResponse', true);
        // return view('pages.tickets');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => "required",
        ]);

        Response::create([
            "user_id" => Auth::user()->id,
            "ticket_id" => $request->ticket_id,
            "body" => $request->body
        ]);

        $response = Response::latest('created_at')
                            ->where('ticket_id', $request->ticket_id)
                            ->first();
        dd($response);
        return view('pages.tickets', ['response', $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
