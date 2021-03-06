<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Ticket;
use App\Models\Status;
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
        $this->middleware('admin')->only('destroy');
    }

    public function index($id)
    {
        $ticket = Ticket::findOrFail($id);
        // $ticket = Ticket::findOrFail($request->ticket_id);
        // dd($ticket);  

        $responses = Ticket::find($ticket->id)->responses; 
        $ticket->responsesCount = count($responses);
        // dd($responses);

        return view('pages.tickets', ['responses' => $responses, 'ticket' => $ticket]);
    }

    public function create(Request $request){
        session(['addResponse' => true]);
        // $showForm = true;
        // $ticket = Ticket::findOrFail($request->ticket_id);
        // dd($ticket->id);
        // return view('pages.tickets' , ['ticket' => $ticket]);
        return redirect()->route('getTicket', ['id' => $request->ticket_id]);
        // return $this->index($request);
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
        
        if (Auth::user()->role == 'admin') {
            $status_id = Status::where('status', 'answered')->pluck('id');
            Ticket::where('id', $request->ticket_id)->update(['status_id' => $status_id[0]]);
        }
        session(["new response" => true]);
        
        // return view('pages.tickets', ['response' => $response]);
        return redirect()->route('getTicket', ['id' => $request->ticket_id]);
        // return $this->index($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        session(['showForm' => $request->response_id]);
        return redirect()->route('getTicket', ['id' => $request->ticket_id]);
        // return $this->index($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $this->validate($request, [
            'response_id' => 'required',
            'body' => 'required'
        ]);

        Response::where('id', $request->response_id)->update(['body' => $request->body]);
        // return redirect()->back();
        return redirect()->route('getTicket', ['id' => $request->ticket_id]);
        // return $this->index($request);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // {
    //     $this->validate($request, [
    //         'ticket_id' => 'required'
    //     ]);

    //     $res = Response::find($request->response_id)->delete();
    //     session()->flash('Ticket delete status', $res);

    //     return redirect()->route('getTicket', ['id' => $request->ticket_id]);

    //     // return $this->index($request);
    // }
}
