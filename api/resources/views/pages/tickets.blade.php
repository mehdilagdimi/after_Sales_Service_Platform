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
        @foreach ($responses as $response)
            <div>
                <h3>Answer : {{ $response->id }}</h3>
                {{ $response->body }}
            </div>
            <div>
                <form action="{{ route('editResponse') }}" method="POST" class="flex justify-end p-6 addTicket-btn">
                    @csrf

                    <input type="hidden" id="response_id" name="response_id" value="{{ $response->id }}">
                    <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                    <button type='submit' class="p-2 bg-white border-2 border-red-400 rounded text-black font-medium">
                        EDIT
                    </button>
                </form>
            </div>
            @if (session('showForm'))
                @if (session('showForm') == $response->id)
                    <div class="box-border flex flex-col justify-center items-center">
                        <form action="{{ route('updateResponse') }}" method="POST"
                            class="box-border bg-white flex flex-col border-solid border-red-400 border-2 w-4/6 max-w-2xl p-5">
                            @csrf
                            
                            <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                            <input type="hidden" id="response_id" name="response_id" value="{{ $response->id }}">
                            {{-- <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}"> --}}
                            <label for="response">Response</label>
                            <textarea name="body" id="response" cols="30" rows="4" required
                                class="text-black border-black border-solid border-2 p-3">
                            {{ $response->body }}
                            </textarea>

                            <button type="submit"
                                class="py-2 px-6 mt-4 mx-auto bg-white border-2 border-orange-600 rounded text-orange-600 font-medium">
                                Update
                            </button>
                        </form>
                    </div>
                @endif
            @endif
        @endforeach
    @endisset
@endsection

@section('addResponse')
    @include('layout.addResponse')
@endsection


@section('footer')
    @include('layout.footer')
@endsection
