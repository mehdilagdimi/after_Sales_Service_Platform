@extends('layout.ticket')

@section('navbar')
    @include('layout.navbar')
@endsection

{{-- {{ $ticket }} --}}
{{-- @section('ticket')
    $ticket;
@endsection --}}
@section('responses')
    @foreach($responses as $response)
    @endforeach
@endsection

@section('addResponse') 
    @include('layout.response')
@endsection


@section('footer') 
    @include('layout.footer')
@endsection

