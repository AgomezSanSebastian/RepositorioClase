<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Gimnasio Adrian DAW2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="home.php?page=login">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php?page=registro">Registrarse</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarUsuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuario
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarUsuario">
                        <a class="dropdown-item" href="home.php?page=listaUsuario">Listar usuarios</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarActividades" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actividades
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarActividades">
                        <a class="dropdown-item" href="home.php?page=listaActividades">Listar Actividades</a>
                        <a class="dropdown-item" href="home.php?page=horario">Horario</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="home.php?page=mensaje">Mensajes</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#">Cerrar sesión</a>
                </li>


            </ul>
        </div>
    </div>
</nav>