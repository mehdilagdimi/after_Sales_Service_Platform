<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <script src="{{ asset('js/app.js')}}"></script> --}}

    <title>Document</title>
</head>

<div class="h-full flex flex-col container items-center mx-auto">
    @yield("navbar")

    <div class="w-full border-none border-gray border-2 rounded-sm">
        <div class="flex flex-row justify-center mx-auto bg-gray-50 border-gray-100 border-1 border-solid rounded-sm w-4/6 p-1 my-3">
            <div class="flex-1 flex flex-row border-solid bg-white border-gray-50 border-0 rounded-sm p-6 m-0">
                <div class="h-22 w-32 max-w-xl p-2 mr-4">
                    <a href="{{ route('getTicket', ['id' => $ticket->id]) }}"><img class=""
                            src="{{ asset('answer-svgrepo-com.svg') }}" alt='png'></a>
                </div>
                <div>
                    <h3 class="text-gray-500 text-xs">REF: {{ $ticket->ref }}</h3>
                    <h3 class="text-gray-500 text-xs">Service : {{ $ticket->service->service }}</h3>
                    <h3 class="font-bold text-lg"> {{ $ticket->subject }}</h3>
                    <p>{{ $ticket->body }}</p>
                    <div class="flex flex-row">
                        <div class="font-tin text-xs ml-4 mt-8">
                            Answers : {{ $ticket->responsesCount }}
                        </div>
                        <div class="font-tin text-xs ml-4 mt-8">
                            {{ $ticket->created_at }}
                        </div>

                    </div>

                </div>

            </div>
            <div class="border-solid bg-white border-gray-50 border-0 rounded-sm p-6 m-0">
                <div class="w-full">
                    <h3 class="text-md font-semibold text-indigo-600">{{ $ticket->status->status }}</h3>

                    <img class="mx-auto h-5 w-auto" src='{{ asset('bookmark-svgrepo-com.svg') }}' alt="pinpoint">
                </div>
            </div>
        </div>
    </div>


    <div class="flex w-full justify-end">
       @if( session("Resolve status"))
       {{-- <p>{{ session("Resolve status") }}</p> --}}
       <div>
           <script>
               alert("Can't resolve unanswered ticket!");
           </script>
        {{-- {{ session("Resolve status") }} --}}
        {{ session()->forget("Resolve status") }}
       </div>
       @endif
        <div>
            <form action="{{ route('resolveTicket', ['id' => $ticket->id]) }}" method="POST" class="flex justify-end p-2 addTicket-btn">
                @csrf

                <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                <button type='submit' class="p-2 bg-green-600 border-2 border-gray-200 rounded-md text-white font-semibold">
                    Resolve
                </button>
            </form>
        </div>
        @admin
        <div>
            <form action="{{ route('closeTicket', ['id' => $ticket->id]) }}" method="POST" class="flex justify-end p-2 addTicket-btn">
                @csrf

                <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                <button type='submit' class="p-2 bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-semibold">
                    Close
                </button>
            </form>
        </div>
        <div>
            <form action="{{ route('deleteTicket') }}" method="POST" class="flex justify-end p-2 addTicket-btn">
                @csrf

                <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                <button type='submit' class="p-2 bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-semibold">
                    Delete
                </button>
            </form>
        </div>
        @endadmin
    </div>
    

    <div class="bg-gray-50 rounded-md p-3 w-full">
        @yield('responses')
    </div>

    @if($ticket->status->status !== 'closed')
    <div>
        <form action="{{ route('createResponse') }}" method="POST" class="flex justify-end p-6 addTicket-btn">
            @csrf

            <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
            <button type='submit'
                class="p-2 bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-semibold">
                Add response
            </button>
        </form>
    </div>
    @endif

    @if (session('addResponse'))
        @yield('addResponse')
        {{ session()->forget('addResponse') }}
        {{ Session::save() }}
    @endif

    @yield('footer')
</div>
