@yield("navbar")

<div class="border-solid border-black border-2 rounded-sm">
    <h3>Service : {{ $ticket->service->service }}</h3>
    <h3>REF: {{ $ticket->ref }}</h3>
    <h3>STATUS : {{ $ticket->status->status }}</h3>
    <h3>SUBJECT : {{ $ticket->subject }}</h3>
    <p>{{ $ticket->body }}</p>

    @admin
    <div>
        <form action="{{ route('deleteTicket') }}" method="POST" class="flex justify-end p-6 addTicket-btn">
            @csrf
    
            <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
            <button type='submit' class="p-2 bg-white border-2 border-red-400 rounded text-black font-medium">
                DELETE
            </button>
        </form>
    </div>
    @endadmin
</div>

@yield('responses')

<div>
    <form action="{{ route('createResponse') }}" method="POST" class="flex justify-end p-6 addTicket-btn">
        @csrf

        <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
        <button type='submit' class="p-2 bg-white border-2 border-red-400 rounded text-black font-medium">
            ADD RESPONSE
        </button>
    </form>
</div>

@if (session('addResponse'))
    @yield('addResponse')
    {{ session()->forget('addResponse') }}
    {{ Session::save() }}
@endif

@yield('footer')
