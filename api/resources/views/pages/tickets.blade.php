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
        <div class="flex flex-row justify-center m-4">
                <div class="flex-1 rounded-lg bg-white border border-black p-4">
                    <h3> {{ $response->body }}
                    </h3>
                </div>
                {{-- Edit button --}}
                    <div class="">
                        <form action="{{ route('editResponse') }}" method="POST" class="flex justify-end p-6 addTicket-btn">
                            @csrf

                            <input type="hidden" id="response_id" name="response_id" value="{{ $response->id }}">
                            <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                            <button type='submit'
                                class="p-2 bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-semibold">
                                EDIT
                            </button>
                        </form>
                    </div>
                    @admin
                    <div>
                        <form action="{{ route('deleteResponse') }}" method="POST" class="flex justify-end p-6 addTicket-btn">
                            @csrf

                            <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                            <input type="hidden" id="response_id" name="response_id" value="{{ $response->id }}">
                            <button type='submit'
                                class="p-2 bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-semibold">
                                DELETE
                            </button>
                        </form>
                    </div>
                    @endadmin
                </div>
                @if (session('showForm'))
                    @if (session('showForm') == $response->id)
                    {{ session()->forget('addResponse') }}
                    {{ Session::save() }}
                        <div class="flex flex-col justify-center items-center bg-white p-3 mx-12 rounded-md mt-3">
                            <form action="{{ route('updateResponse') }}" method="POST"
                                class="bg-white flex flex-col border-solid border-indigo-600 border-2 w-full p-5 rounded-md">
                                @csrf

                                <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                                <input type="hidden" id="response_id" name="response_id" value="{{ $response->id }}">
                                {{-- <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}"> --}}
                                <label for="response">Response</label>
                                <textarea name="body" id="response" cols="30" rows="4" required
                                    class="text-black border-gray-200 border-solid border-2 p-3 m-3 rounded-md">
                            {{ $response->body }}
                            </textarea>

                                <button type="submit"
                                    class="py-2 px-6 mt-4 mx-auto bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-bold">
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
