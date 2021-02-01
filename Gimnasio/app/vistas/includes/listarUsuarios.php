<div class="container-fluid mt-5">
    <div class="text-center pt-3">
        <h2>Usuarios del gimnasio:</h2>
    </div>
    <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
    <?php if (isset($mensajes)) {
        foreach ($mensajes as $mensaje) : ?>
            <div class="alert alert-<?= $mensaje["tipo"] ?> mt-5"><?= $mensaje["mensaje"] ?></div>
    <?php endforeach;
    } ?>
    <div class="text-center mb-3">
        <div class="btn-group open">
            <a class="btn btn-primary" href="#"><i class="icon-user"></i> Registros por página:</a>
            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                </span></a>
            <ul class="dropdown-menu">
                <li><a href="?controller=User&accion=listarUser&regsxpag=2"> <i class="icon-fixed-width icon-th"></i> 2</a></li>
                <li><a href="?controller=User&accion=listarUser&regsxpag=4"> <i class="icon-fixed-width icon-th"> </i> 4</a></li>
                <li><a href="?controller=User&accion=listarUser&regsxpag=8"> <i class="icon-fixed-width icon-th"></i> 8</a></li>
                <li><a href="?controller=User&accion=listarUser&regsxpag=10"><i class="icon-fixed-width icon-th"></i> 10</a></li>
            </ul>
            <div class="col-lg-6">
                <form class="form-inline" method="POST" action="?controller=User&accion=buscar" id="buscaUsuarios">
                    <label for="nombre" class=" col-form-label text-left">Buscar: 
                        <label class="col-lg-1"></label>
                        <input type="text" class="col-lg-5 form-control" id="nombre" name="nombre" placeholder="" />
                        <label class="col-lg-1"></label>
                        <button class="btn btn-secondary" type="submit" name="submit" id="submit">Buscar</button>
                    </label>

                    
                </form>
            </div>

        </div>
    </div>

    <div class="text-center mb-3">




        <!--Creamos la tabla que utilizaremos para el listado:-->
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>NIF</th>
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>Imagen</th>
                <th><strong>LOGIN</strong></th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Rol</th>
                <!-- Añadimos una columna para las operaciones que podremos realizar con cada registro -->
                <th>Operaciones</th>
            </tr>
            <!--Los datos a listar están almacenados en $parametros["datos"], que lo recibimos del controlador-->
            <?php foreach ($datos as $dato) : ?>
                <!--Mostramos cada registro en una fila de la tabla-->
                <tr>
                    <td><?= $dato["id"] ?></td>
                    <td><?= $dato["nif"] ?></td>
                    <td><?= $dato["nombre"] ?></td>
                    <td><?= $dato["apellido1"] ?></td>
                    <td><?= $dato["apellido2"] ?></td>
                    <?php if ($dato["imagen"] !== NULL) : ?>
                        <td><img src="fotos/<?= $dato['imagen'] ?>" width="40" /></td>
                    <?php else : ?>
                        <td>----</td>
                    <?php endif; ?>
                    <td><?= $dato["login"] ?></td>
                    <td><?= $dato["email"] ?></td>
                    <td><?= $dato["telefono"] ?></td>
                    <td><?= $dato["direccion"] ?></td>
                    <!-- columna del ROL -->
                    <?php if ($dato["rol"] == 0) : ?>
                        <td>Administrador
                            <a href="?controller=user&accion=cambiarRolActivos&id=<?= $dato['id'] ?>&rol=2">Desactivar </a>
                            <a href="?controller=user&accion=cambiarRolActivos&id=<?= $dato['id'] ?>&rol=1">Hacer Socio </a>
                        </td>
                    <?php elseif ($dato["rol"] == 1) : ?>
                        <td>Socio
                            <a href="?controller=user&accion=cambiarRolActivos&id=<?= $dato['id'] ?>&rol=2">Desactivar </a>
                            <a href="?controller=user&accion=cambiarRolActivos&id=<?= $dato['id'] ?>&rol=0">Hacer Administrador </a>
                        </td>
                    <?php elseif ($dato["rol"] == 2) : ?>
                        <td>Por Validar</td>
                    <?php else : ?>
                        <td>----</td>
                    <?php endif; ?>
                    <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
                    <td>
                        <a href="?controller=user&accion=editarUser1&id=<?= $dato['id'] ?>">Editar </a>
                        <a href="?controller=user&accion=deluser&id=<?= $dato['id'] ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php //Sólo mostramos los enlaces a páginas si existen registros a mostrar
        if ($totalregistros >= 1) :
        ?>
            <nav aria-label="Page navigation example" class="text-center">
                <ul class="pagination">

                    <?php
                    //Comprobamos si estamos en la primera página. Si es así, deshabilitamos el botón 'anterior'
                    if ($pagina == 1) : ?>
                        <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?controller=User&accion=listarUser&pagina=<?php echo $pagina - 1; ?>&regsxpag=<?= $regsxpag ?>"> &laquo;</a></li>
                    <?php
                    endif;
                    //Mostramos como activos el botón de la página actual
                    for ($i = 1; $i <= $numpaginas; $i++) {
                        if ($pagina == $i) {
                            echo '<li class="page-item active"> 
                <a class="page-link" href="?controller=User&accion=listarUser&pagina=' . $i . '&regsxpag=' . $regsxpag . '">' . $i . '</a></li>';
                        } else {
                            echo '<li class="page-item"> 
                <a class="page-link" href="?controller=User&accion=listarUser&pagina=' . $i . '&regsxpag=' . $regsxpag . '">' . $i . '</a></li>';
                        }
                    }
                    //Comprobamos si estamos en la última página. Si es así, deshabilitamos el botón 'siguiente'
                    if ($pagina == $numpaginas) : ?>
                        <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?controller=User&accion=listarUser&pagina=<?php echo $pagina + 1; ?>&regsxpag=<?= $regsxpag ?>"> &raquo; </a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif;  //if($totalregistros>=1): 
        ?>


    </div>