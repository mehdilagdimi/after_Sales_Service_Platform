@yield("navbar")
<div class="border-solid border-black border-2 rounded-sm">
    <h3>Service : {{$ticket->service->service}}</h3>
    <h3>REF: {{$ticket->ref}}</h3>
    <h3>STATUS : {{$ticket->status->status}}</h3>
    <h3>SUBJECT : {{$ticket->subject}}</h3>
    <p>{{$ticket->body}}</p>
</div>

@yield('footer')