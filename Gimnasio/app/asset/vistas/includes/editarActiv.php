<div class="container">
    <div class="row mt-5">
        <?php // Mostramos los mensajes procedentes del controlador que se hayn generado
        foreach ($mensajes as $mensaje) : ?>
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach; ?>

        <div class="col-lg-3"></div>

        <div class="col-lg-12 mt-5 mb-5 form_login">
            <form class="form-signin" method="POST" action="?controller=User&accion=editarActiv&id=<?= $id ?>" id="actividades">

                <div class="form-group row mt-4">
                    <label for="nombre" class="col-lg-4 col-form-label text-center">Nombre actividad: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $datos["nombre"] ?>" />
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="descripcion" class="col-lg-4 col-form-label text-center">Descripcion actividad: </label>
                    <div class="col-lg-7 text-left">
                        <textarea class="form-control" id="descripcion" name="descripcion"><?= $datos["descripcion"] ?></textarea>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="aforo" class="col-lg-4 col-form-label text-center">Aforo actividad: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="aforo" name="aforo" value="<?= $datos["aforo"] ?>" />
                    </div>
                </div>
                <div class="row mt-5 text-center">
                    <label class="col-lg-5"></label>
                    <button class="btn btn-secondary btn-lg" type="submit" name="submit" id="submit">Modificar</button>
                </div>
                <div class="form-group row mt-4 invisible">
                    <label for="id" class="col-lg-2 col-form-label text-center">id: </label>
                    <div class="col-lg-2 text-left">
                        <input type="text" id="id" name="id" value="<?= $id ?>" />
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>