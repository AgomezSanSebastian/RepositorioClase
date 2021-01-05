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
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Aforo</th>
            <th>Operaciones</th>
        </tr>
        <!--Los datos a listar están almacenados en $parametros["datos"], que lo recibimos del controlador-->
        <?php foreach ($datos as $dato) : ?>
            <!--Mostramos cada registro en una fila de la tabla-->
            <tr>
                <td><?= $dato["id"] ?> </td>
                <td><?= $dato["nombre"] ?></td>
                <td><?= $dato["descripcion"] ?></td>
                <td><?= $dato["aforo"] ?></td>

                <td>
                    <a href="?controller=user&accion=editarActiv&id=<?= $dato['id'] ?>">Editar </a>
                    <a href="?controller=user&accion=delActividad&id=<?= $dato['id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="row mt-5">

        <div class="col-lg-3"></div>

        <div class="col-lg-6 mt-5 mb-5 form_login">
            <form class="form-signin" method="POST" action="?controller=User&accion=agregarActividad" id="actividades">

                <div class="form-group row mt-4">
                    <label for="nombre" class="col-lg-4 col-form-label text-center">Nombre actividad: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" />
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="descripcion" class="col-lg-4 col-form-label text-center">Descripcion actividad: </label>
                    <div class="col-lg-7 text-left">
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="aforo" class="col-lg-4 col-form-label text-center">Aforo actividad: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="aforo" name="aforo" placeholder="0" />
                    </div>
                </div>
                <div class="row mt-5 text-center">
                    <label class="col-lg-5"></label>
                    <button class="btn btn-secondary btn-lg" type="submit" name="submit" id="submit">Agregar</button>
                </div>

            </form>
        </div>
    </div>

</div>