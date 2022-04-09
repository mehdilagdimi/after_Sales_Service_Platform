

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
<nav class="p-5 bg-red-500 flex justify-end w-full">
    <ul class="flex items-center">
        <li>
            <a href="" class="p-4">   Home 
            </a>
        </li>
        <li>
            <a href="" class="p-4"> Authenticate
            </a>
        </li>
        <li>
            <a href="" class="p-4"> Authenticate
            </a>
        </li>
        <li>
            <form action="{{ route('logout')}}" method='POST' class="p-3 inline">
                @csrf
                
                <button type='submit'>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
@endsection
