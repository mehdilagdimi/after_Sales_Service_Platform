@extends('layout.ticket')

@section('navbar')
    @include('layout.navbar')
@endsection

{{-- {{ $ticket }} --}}
{{-- @section('ticket')
    $ticket;
@endsection --}}
@section('responses')
    @isset($responses)
        @foreach($responses as $response)
            <div>
                <h3>Answer : {{ $response->id }}</h3>
                {{ $response->body }}
            </div>
        @endforeach
    @endisset
@endsection

@section('addResponse') 
    @include('layout.addResponse')
@endsection


@section('footer') 
    @include('layout.footer')
@endsection

