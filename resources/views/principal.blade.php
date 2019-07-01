<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Azriel Laravel Vue Js- ">
    <meta name="author" content="">
    <meta name="keyword" content="Azriel Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="img/logo-msc.png">
    <title>Azriel-Parroquia San Luis Mariona</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
                    <div class="contenido1">
                    <table class="table-banner">
                    <colgroup>
				<col class="col1-banner"/>
				<col class="col2-banner"/>
			</colgroup>
                    <tr>
                        <td rowspan="3"><img src="img/logo-msc.png" class="img-logos"></td>
                    </tr>
                    <tr>
                       <td class="text-center-banner1 font-banner1"> PARROQUIA DE SAN LUIS MARIONA</td>
                    </tr>
                    <tr>
                       <td class="text-center-banner2">MISIONEROS DEL SAGRADO CORAZÓN</td>
                    </tr>
</table>
                    </div>
    <div id="app">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
       <div class="divmenu">
        <a>Menú</a>
       </div>
       <!-- <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a>Menú</a>
            </li>
        </ul>-->
        <!-- -->
         <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Notificaciones</strong>
                    </div>
                   <!-- <a class="dropdown-item" href="#">
                        <i class="fa fa-envelope-o"></i> Ingresos
                        <span class="badge badge-success">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-tasks"></i> Ventas
                        <span class="badge badge-danger">2</span>
                    </a> -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">{{Auth::user()->usuario}} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick= "event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul> 

        <!-- -->
    </header>

    <div class="app-body">
      
      
      @if (Auth::check())
            @if(Auth::user()->idrol==1)
                @include('plantilla.sidebarparroco')
            @elseif(Auth::user()->idrol==2)
                @include('plantilla.sidebarsecretaria')
            @else
            @endif
      @endif
      
        <!-- Contenido Principal -->
     @yield('contenido')
        <!-- /Fin del contenido principal -->
    </div>
    </div>
    
    <!--
    <footer class="app-footer">
    </footer>
 -->
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>