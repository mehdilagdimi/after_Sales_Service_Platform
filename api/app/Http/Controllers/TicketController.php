<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Service;
use App\Models\Status;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('client')->only('create', 'store');
        $this->middleware('admin')->only('destroy');
    }

    public function index()
    {
        if (Auth::user()->role == 'client') {
            $user_id = Auth::user()->id;
            $tickets = User::find($user_id)->tickets;
            foreach ($tickets as $ticket) {
                $responses = Ticket::find($ticket->id)->responses;
                $ticket->responsesCount = count($responses);
            }
        } else {
            $tickets = Ticket::orderBy('created_at', 'desc')
                ->paginate(10);
            foreach ($tickets as $ticket) {
                $responses = Ticket::find($ticket->id)->responses;
                $ticket->responsesCount = count($responses);
            }
        }
        return view('pages.dashboard', ['tickets' => $tickets]);
    }

    public function create(Request $request)
    {
        // $this->validate($request, [
        //     'showForm' => 'required'
        // ]);
        session(['showForm' => 'true']);
        return redirect()->route('dashboard');
        // return view('pages.addticket');
    }

    public function store(Request $request)
    {
        // dd($request);
        session()->forget('showForm');
        $this->validate($request, [
            'subject' => 'string|max:150',
            'body' => 'required'
        ]);

        $latestTicket = Ticket::where('user_id', Auth::user()->id)
            ->latest('created_at')
            ->first();

        if ($latestTicket == null) {
            $addToRef = 0;
        } else {
            $pos = strpos($latestTicket->ref, "REF");
            $ticketNum = (int)(substr($latestTicket->ref, ($pos + 5)));
            //increment the number
            $addToRef = strval($ticketNum + 1);
        }

        $ref = Auth::user()->id . 'REF' . Auth::user()->fname[0] . Auth::user()->lname[0] . $addToRef;
        // dd($ref);

        Ticket::create([
            'ref' => $ref,
            'user_id' => Auth::user()->id,
            'service_id' => $request->get('service'),
            //'new' status is of id 1
            'status_id' => 1,
            'subject' => ($request->get('subject') == null ? "Assistance" : $request->get('subject')),
            'body' => $request->get('body')
        ]);

        $ticket = Ticket::where('ref', $ref)->firstOrFail();
        // $ticket = Ticket::latest('created_at')->first();

        // dd($ticket->service->service);
        // dd($ticket->status->status);
        // dd($ticket->user->fname);
        // dd($ticket->user->lname);

        // dd($ticket);
        return redirect()->route('getTicket', ['id' => $ticket->id]);
        // return view('pages.tickets', ['ticket' => $ticket]);
    }

    public function resolve(Request $request)
    {

        $status_id = Status::where('status', 'resolved')->pluck('id');
        $status_answered = Status::where('status', 'answered')->pluck('id');
        
        if(Ticket::where('id', $request->ticket_id)->pluck('status_id') == $status_answered){
            Ticket::where('id', $request->ticket_id)->update(['status_id' => $status_id[0]]);
        } else {
            session(["Resolve status" => "Can't be resolved with no answers ticket"]);
            session()->save();
        }
        return redirect()->route('getTicket', ['id' => $request->ticket_id]);
    }

    public function close(Request $request)
    {
        $status_id = Status::where('status', 'closed')->pluck('id');
        Ticket::where('id', $request->ticket_id)->update(['status_id' => $status_id[0]]);
        return redirect()->route('getTicket', ['id' => $request->ticket_id]);
    }


    public function destroy(Request $request)
    {
        $this->validate($request, [
            'ticket_id' => 'required'
        ]);

        $res = Ticket::find($request->ticket_id)->delete();
        session()->flash('Ticket delete status', $res);

        return redirect()->route('dashboard');
    }
}
