<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
{{-- @vite(['resources/js/app.js'])--}}

    <title>Inshin.org</title>
</head>
<body>
<div class="container">
   <div class="row">
       <ul class="nav nav-pills">
           @guest()
               <li class="nav-item">
                   <a class="nav-link" href="{{ route('login') }}">Логин</a>
               </li>
           @endguest
       </ul>
   </div>
    @yield('content')
</div>

</body>
</html>
