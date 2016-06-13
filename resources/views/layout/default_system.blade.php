<html>

<head>

    <title>Sistema Anuncia</title>

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    @yield('header')

</head>

    <body>

    @yield('menu')

    <div class="container">
        @yield('content')
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/js/all.js') }}"></script>
    @yield('footer')
    </body>

</html>