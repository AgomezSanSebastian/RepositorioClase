<!-- Page Content -->

<div class="container mb-5">
    <div class="row mt-5">

        <div class="col-lg-3"></div>
        <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : ?>
                <div class="alert alert-<?= $mensaje["tipo"] ?> mt-5"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
        } ?>

        <div class="col-lg-6 form_login mt-5">
            <form class="form-signin" method="POST" action="?controller=User&accion=editarPerfil&login=<?= $login ?>" >



                <div class="form-group row">
                    <label for="nombre" class="col-lg-4 col-form-label text-center">Nombre: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $datos["nombre"] ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido1" class="col-lg-4 col-form-label text-center">1º Apellido: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?= $datos["apellido1"] ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido2" class="col-lg-4 col-form-label text-center">2º Apellido: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?= $datos["apellido2"] ?>"/>                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nif" class="col-lg-4 col-form-label text-center">NIF: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nif" name="nif" maxlength="9" value="<?= $datos["nif"] ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-lg-4 col-form-label text-center">Email: </label>
                    <div class="col-lg-7 text-left">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $datos["email"] ?>" />
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <label for="password" class="col-lg-4 col-form-label text-center">Password: </label>
                    <div class="col-lg-7 text-left">
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefono" class="col-lg-4 col-form-label text-center">Teléfono: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $datos["telefono"] ?>"/>        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="direccion" class="col-lg-4 col-form-label text-center">Direccion: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $datos["direccion"] ?>" />
                    </div>
                </div>

                <div class="row mt-5">
                    <label class="col-lg-5"></label>
                    <button class="btn btn-secondary btn-lg" type="submit" name="submit">Ingresar</button>
                </div>

                <div class="form-group row invisible">
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="id" name="id" value="<?= $datos["id"] ?>" />
                    </div>
                </div>
                <div class="form-group row invisible">
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="login" name="login" value="<?= $login ?>" />
                    </div>
                </div>


                
            </form>

        </pre>
        </div>
    </div>
</div>

<!-- /.container -->