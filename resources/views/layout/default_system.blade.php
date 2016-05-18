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

@yield('footer')
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>