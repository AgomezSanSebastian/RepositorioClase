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

</div>