<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="?controller=User&accion=homeUsuario">Gimnasio Adrian DAW2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarUsuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuario
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarUsuario">
                        <a class="dropdown-item" href="?controller=User&accion=editarPerfil&login=<?= $_SESSION['login']; ?>">
                            Modificar perfil
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarActividades" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actividades
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarActividades">
                        <a class="dropdown-item" href="?controller=User&accion=listarActividades">Listar Actividades</a>
                        <a class="dropdown-item" href="?controller=User&accion=horario">Horario</a>
                        <a class="dropdown-item" href="?controller=User&accion=mostrarClasesUser&id=<?= $_SESSION['id']; ?>">Clases apuntadas</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?controller=User&accion=cargarMensajeUser">Mensajes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled"><?php echo "" . $_SESSION['login'] . "" ?></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="?controller=User&accion=cerrarSesion">Cerrar sesión</a>
                </li>


            </ul>
        </div>
    </div>
</nav>