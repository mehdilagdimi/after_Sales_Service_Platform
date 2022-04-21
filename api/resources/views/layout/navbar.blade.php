

@section('navbar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>

<nav class="p-2 bg-gray-50 flex justify-end w-full border-b-2 border-indigo-600">
    <ul class="flex items-center text-sm font-semibold">
        <li>
            <a href="" class="p-4">   Home 
            </a>
        </li>
        @guest
        <li>
            <a href="{{ route('signup')}}" class="p-4">   Sign up
            </a>
        </li>
        <li>
            <a href="{{ route('auth')}}" class="p-4">   Login 
            </a>
        </li>
        @endguest
        @auth
        <li>
            <a href="" class="p-4"> Profile
            </a>
        </li>
        
        <li>
            <form action="{{ route('logout')}}" method='POST' class="p-3 inline">
                @csrf
                
                <button type='submit' class="text-sm font-semibold">
                    Logout
                </button>
            </form>
        </li>
        @endauth
    </ul>
</nav>
@endsection
