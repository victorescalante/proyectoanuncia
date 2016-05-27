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

    @yield('footer')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>

</html>