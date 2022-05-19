

@section('navbar')


<nav class="p-2 flex justify-end w-full bg-navBorder shadow-md">
    <ul class="flex items-center text-sm font-semibold">
        <li>
            <a href="{{ route('dashboard')}}" class="p-4">   Home 
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
