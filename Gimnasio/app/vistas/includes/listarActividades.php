<div class="container-fluid mt-5">
    <div class="text-center pt-3">
        <h2>Actividades del gimnasio:</h2>
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
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Aforo</th>
        </tr>
        <!--Los datos a listar están almacenados en $parametros["datos"], que lo recibimos del controlador-->
        <?php foreach ($datos as $dato) : ?>
            <!--Mostramos cada registro en una fila de la tabla-->
            <tr>
                <td><?= $dato["nombre"] ?></td>
                <td><?= $dato["descripcion"] ?></td>
                <td><?= $dato["aforo"] ?></td>
            </tr>

        <?php endforeach; ?>
    </table>
</div>