<div class="row mt-5">

    <div class="text-center col-lg-12 pt-3">
        <h2>Mostrar Clases:</h2>
    </div>


    <div class="col-lg-12">
        <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : ?>
                <div class="alert alert-<?= $mensaje["tipo"] ?> mt-5"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
        } ?>
    </div>

    <!--Creamos la tabla que utilizaremos para el listado:-->
    <div class="col-lg-2"></div>
    <table class="table table-striped col-lg-8">
        <tr>
            <th>Actividad</th>
            <th>Día</th>
            <th>Hora de inicio</th>
            <th>Fecha de la reserva</th>
        </tr>
        <!--Los datos a listar están almacenados en $parametros["datos"], que lo recibimos del controlador-->

        <?php foreach ($datos as $dato) : ?>
            <!--Mostramos cada registro en una fila de la tabla-->
            <tr>
                <td><?= $dato["nombre"] ?></td>
                <td><?= $dato["fecha_actividad"] ?></td>
                <td><?= $dato["hora_activ"] ?></td>
                <td><?= $dato["fecha_reserva"] ?></td>
            </tr>

        <?php endforeach; ?>
    </table>

</div>