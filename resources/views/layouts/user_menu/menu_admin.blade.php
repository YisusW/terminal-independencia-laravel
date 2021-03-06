<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
                
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                         Usuarios <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li><a href="{{ route('register') }}">Registrar</a></li>
                        <li><a href="{{ url('users') }}">Lista</a></li>

                    </ul>            
                
                </li>

                @if( Auth::user() )
                <li class="dropdown">
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    
                        Tasa Salida <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li><a href="{{ url('tasa-salida-config') }}">Asignar Pricio</a></li>
                        
                        <li><a href="{{ url('open-jornada-tasa') }}">Abrir Jornada</a></li>
                        
                        <li><a href="{{ url('jornada-opened') }}">Jornadas Abiertas</a></li>

                        <li><a href="{{ url('jornada-closed') }}">Jornadas Cerradas</a></li>

                    </ul>                        
                    
                </li>
                {{-- Menu de listin admin --}}
                <li class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Listin<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                                                        
                        <li><a href="{{ url('tipo-listine') }}">Asignar Tipo</a></li>

                        <li><a href="{{ url('tipo-listine-price') }}">Asignar Precio</a></li>

                        <li><a href="{{ url('open-jornada-listine') }}">Abrir Jornada</a></li>

                        <li><a href="{{ url('jornada-opened-listin') }}">Jornadas Abiertas</a></li>

                        <li><a href="{{ url('jornada-closed-listin') }}">Jornadas Cerradas</a></li>


                    </ul>                        
                    
                </li>                 
                @endif

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())

                    <li><a href="{{ route('login') }}">Inicio</a></li>
                    <li><a href="{{ route('register') }}">Registro</a></li>

                @else

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Salir
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>