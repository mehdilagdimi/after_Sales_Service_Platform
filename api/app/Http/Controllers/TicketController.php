<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

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
        // $this->validate($request, [
        //     'showForm' => 'required'
        // ]);
        // dd(session()->all());
        // dd($request);
      
        // session()->put('showForm' , 'yes');
        // dd(session()->all());
        session(['showForm' => 'true']);
        return redirect()->route('dashboard');
        // return view('pages.addticket');
    }

    public function store(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);
        
        $latestTicket = Ticket::where('user_id', Auth::user()->id)
                        ->latest()
                        ->first();

        if($latestTicket == null) {
            $addToRef = 0;
        } else {
            $pos = strpos($latestTicket->ref, "REF");
            $ticketNum = (int)(substr($latestTicket->ref, ($pos + 5)));
            $addToRef = strval($ticketNum + 1);
        }
        
        $ref = Auth::user()->id .'REF'. Auth::user()->fname[0] . Auth::user()->lname[0] . $addToRef;
        // dd($ref);

        Ticket::create([
            'ref' => $ref,
            'service' => $request->get('service'),
            'status' => 'new',
            'subject' => ($request->get('subject') == null ? "Assistance" : $request->get('subject')),
            'body' => $request->get('body')
        ]);

        return view('tickets');
    }

    public function ticket(){

    }

    public function destroy(){
        var_dump(Auth::user()->role);
        dd('test admin nmiddleware');
    }

}
