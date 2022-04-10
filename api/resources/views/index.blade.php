
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

      @auth
          You are authenticated {{ Auth::user()->fname }} {{ Auth::user()->lname }}

      @endauth
</body>
<footer>
    @yield('footer')
</footer>
</html>