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

    <!-- El formulario -->
    <div class="col-lg-3"></div>

    <div class="col-lg-6 mt-5 mb-5 form_login">
        <form class="form-signin" method="POST" action="?controller=User&accion=CargarClasesAdmin" id="mostrarClasesDesdeAdmin">

            <div class="form-group row mt-4">
                <label for="nombre" class="col-lg-4 col-form-label text-center">Nombre actividad: </label>
                <div class="col-lg-7 text-left">
                    <select class="custom-select form-control" name='nombre'>
                        <?php
                        foreach ($datos as $dato) {
                            echo "<option value='{$dato['id']}' id='id'>{$dato['nombre']}, {$dato['dia']} - {$dato['inicio']} </option>\n";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mt-5 text-center">
                <label class="col-lg-5"></label>
                <button class="btn btn-secondary btn-lg" type="submit" name="submit" id="submit">Mostrar clase</button>
            </div>
        </form>
    </div>

    <div class="col-lg-3"></div>

    <!-- La tabla -->
    <div class="col-lg-2"></div>
    <!--Creamos la tabla que utilizaremos para el listado:-->
    <table class="table table-striped col-lg-8">
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Teléfono</th>
        </tr>
        <!--Los datos a listar están almacenados en $parametros["datos"], que lo recibimos del controlador-->
        
        <?php foreach ($cargas as $carga) : ?>
            <!--Mostramos cada registro en una fila de la tabla-->
            <tr>
                <td><?= $carga["login"] ?></td>
                <td><?= $carga["nombre"] ?></td>
                <td><?= $carga["apellido1"] ?></td>
                <td><?= $carga["apellido2"] ?></td>
                <td><?= $carga["telefono"] ?></td>
            </tr>

        <?php endforeach; ?>
    </table>
</div>