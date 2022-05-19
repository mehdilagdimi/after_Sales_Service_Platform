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
            <div class="flex flex-row justify-between mx-auto w-4/6 p-3 flex-wrap">
                <div class="flex flex-row justify-between items-center w-full m-2">
                    <div class="flex shrink flex-col items-center justify-center m-2">
                        <div>
                        <img class="rounded-full h-16 w-16 p-2 m-1" src="{{ asset('man.png') }}" alt="Avatar">
                        </div>
                        @admin
                            <form action="{{ route('deleteUser') }}" method="POST">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value="{{ $ticket->user_id }}">
                                <button type='submit'><img class="rounded-full h-8 w-8 max-w-sm p-2"
                                        src="{{ asset('delete.png') }}" alt="delete user">
                                </button>
                            </form>
                        @endadmin
                        <div class="text-center m-2 p-1">
                        @if ($response->user->role == 'admin')
                            <h3 class="text-sm font-bold w-16 m-1"> Assistant </h3>
                        @else
                            <h3 class="text-sm font-bold w-16 m-1">{{ $ticket->user->fname }} {{ $ticket->user->lname }}</h3>
                        @endif
                        </div>
                    </div>

                    <div class="shrink-0 rounded-lg bg-white border border-black w-5/6 p-4 mt-8">
                        <div>
                            {{ $response->body }}
                        </div>
                    </div>
                </div>
                @client
                    <div class="">
                        <form action="{{ route('editResponse') }}" method="POST" class="flex justify-end p-6 mt-8">
                            @csrf

                            <input type="hidden" id="response_id" name="response_id" value="{{ $response->id }}">
                            <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                            <button type='submit'
                                class="p-2 bg-navBorder shadow  rounded-md text-white font-semibold">
                                EDIT
                            </button>
                        </form>
                    </div>
                @endclient
                {{-- @admin
                <div>
                    <form action="{{ route('deleteResponse') }}" method="POST" class="flex justify-end p-6 mt-8">
                        @csrf

                        <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" id="response_id" name="response_id" value="{{ $response->id }}">
                        <button type='submit'
                            class="p-2 bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-semibold">
                            DELETE
                        </button>
                    </form>
                </div>
                @endadmin --}}
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
                                class="text-black border-gray-200 max-w-sm border-solid border-2 p-3 m-3 rounded-md">
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
    <footer class="absolute md:container  bottom-0  w-full ">
        @include('layout.footer')
    </footer>
@endsection
