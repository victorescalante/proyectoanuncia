<html>
<head>
    <title>Primera app - Anuncia</title>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/fuentes/stylesheet.css') }}">
</head>
@yield('header')
<body class="red-background">
<nav class="navbar navbar-default portal">
    <div class="container">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="http://anuncia.cc/img/loguito.jpg">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ url('/') }}">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('catalogo') }}">Catálogo</a></li>
                    <li><a href="{{ url('contacto') }}">Contacto</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>
@yield('background')
<div class="container">
<!--
    @if($currentUser)
    Hola {{ $currentUser->name }},
      <a href="{{ route('auth_destroy_path') }}">Salir</a>
    @else
    <a href="{{ route('auth_show_path') }}">Iniciar Sesión</a>
    @endif
        -->
    @yield('content')
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
@yield('js_map')
@yield('footer')
</body>
</html>