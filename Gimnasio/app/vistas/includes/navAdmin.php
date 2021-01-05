<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">

    <a class="navbar-brand" href="#">Gimnasio Adrian DAW2</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarUsuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarUsuario">
                    <a class="dropdown-item" href="?controller=User&accion=listarUser">Listar usuarios</a>
                    <a class="dropdown-item" href="?controller=User&accion=listarNoActivos">Usuarios no activados</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarActividades" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actividades
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarActividades">
                    <a class="dropdown-item" href="?controller=User&accion=listarActividadesAdmin">Listar Actividades</a>
                    <a class="dropdown-item" href="home.php?page=horario">Horario</a>
                    <a class="dropdown-item" href="home.php?page=horario">Agregar Clase</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="home.php?page=mensaje">Mensajes</a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled"><?php echo "" . $_SESSION['login'] . "" ?></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="?controller=User&accion=cerrarSesion">Cerrar sesión</a>
            </li>


        </ul>
    </div>

</nav>