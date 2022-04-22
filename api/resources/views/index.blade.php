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

<body>
    <div class="container mx-auto px-30">

        @yield('navbar')

        {{-- <div class="container mx-auto px-30"> --}}
        @guest
            @yield("register")
        @endguest

        @auth
            @client
            <form action="{{ route('createTicket') }}" method='POST' class="flex justify-end p-6 addTicket-btn">
                @csrf
                <div class="p-1 bg-gray-100 rounded-lg mx-20">
                    <button type='submit' class="p-2 bg-white border-2 border-black rounded text-black font-semibold">
                        ADD TICKET</button>
                </div>
            </form>

            {{-- Show only when button above is clicked 'Need assistance?' --}}
            @if (session('showForm'))
                {{ session()->forget('showForm') }}
                <div class="flex flex-col justify-center items-center bg-gray-50 p-3 mx-80 rounded-md">
                    <form action="{{ route('storeTicket') }}" method='POST'
                        class="bg-white flex flex-col border-solid border-indigo-600 border-2 w-full p-5 rounded-md">
                        @csrf
                        {{-- <label for="service">Service</label> --}}
                        <select id="service" name='service' class="p-3 border-2 border-gray-200 border-solid rounded-md m-3">
                            <option value="1">Healthcare</option>
                            <option value="2">Electronic Equipment</option>
                            <option value="3">Mechanical Equipment</option>
                            <option value="4">Maintenance</option>
                        </select>
                        {{-- <label for="subject">Subject</label> --}}
                        <input name="subject" id='subject' type="text" placeholder='Subject'
                            class="border-gray-200 border-solid border-2 p-3 m-3 rounded-md" required>
                        {{-- <label for="body">Describe your situation</label> --}}
                        <textarea name="body" id="body" cols="30" rows="4" required placeholder="Description.."
                            class="text-black border-gray-200 border-solid border-2 p-3 m-3 rounded-md">
                 </textarea>

                        <button type="submit"
                            class="py-2 px-6 mt-4 mx-auto bg-indigo-600 border-2 border-gray-200 rounded-md text-white font-bold">
                            Submit </button>
                    </form>
                </div>
            @endif
            @endclient
            <div class="bg-white p-3">
                @foreach ($tickets as $ticket)
                    <div class="flex flex-row  bg-gray-50 border-gray-100 border-1 border-solid rounded-sm mx-20 p-1 m-4">
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

                                <img class="mx-auto h-5 w-auto" src='{{ asset('bookmark-svgrepo-com.svg') }}'
                                    alt="pinpoint">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endauth
    </div>
</body>


<footer>
    <div class="container mx-auto px-30">
        @yield('footer')
    </div>
</footer>

</html>
