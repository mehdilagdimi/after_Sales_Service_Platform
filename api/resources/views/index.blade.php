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
    <div class="flex items-center md:container md:mx-auto px-16">
        @yield('navbar')
    </div>
    @guest
        You are not Authenticated
        @yield("register")
    @endguest

    @client
    <form action="{{ route('createTicket') }}" method='POST' class="flex justify-end p-6 addTicket-btn">
        @csrf
        <button type='submit' class="p-2 bg-white border-2 border-red-400 rounded text-black font-medium">Need
            Assistance?</button>
    </form>

    {{-- Show only when button above is clicked 'Need assistance?' --}}
    @if (session('showForm'))
        {{ session()->forget('showForm') }}
        <div class="box-border flex flex-col justify-center items-center">
            <form action="{{ route('storeTicket') }}" method='POST'
                class="box-border bg-white flex flex-col border-solid border-red-400 border-2 w-4/6 max-w-2xl p-5">
                @csrf
                <label for="service">Service</label>
                 <select id="service" name='service' class="p-3 border-2 border-black border-solid">
                    <option value="1">Healthcare</option>
                    <option value="2">Electronic Equipment</option>
                    <option value="3">Mechanical Equipment</option>
                    <option value="4">Maintenance</option>
                  </select>                  
                <label for="subject">Subject</label>
                <input name="subject" id='subject' type="text" placeholder='Subject' class="border-black border-solid border-2 p-3"
                    required>
                <label for="body">Describe your situation</label>
                <textarea name="body" id="body" cols="30" rows="4" required placeholder="Description.." class="text-black border-black border-solid border-2 p-3">
                 </textarea>

                 <button type="submit" class="py-2 px-6 mt-4 mx-auto bg-white border-2 border-orange-600 rounded text-orange-600 font-medium"> SUBMIT </button>
            </form>
        </div>
    @endif
    @endclient

    @auth

        You are authenticated {{ Auth::user()->fname }} {{ Auth::user()->lname }}

    @endauth
</body>

<footer>
    @yield('footer')
</footer>

</html>
