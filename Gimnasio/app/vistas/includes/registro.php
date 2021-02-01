<!-- Page Content -->

<div class="container mb-5">
    <div class="row mt-5">

        <div class="col-lg-3"></div>

        <div class="col-lg-6 form_login mt-5">
            <form class="form-signin" method="POST" action="?controller=Login&accion=registrar" enctype="multipart/form-data">

                <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
                <?php if (isset($correcto)) {
                    foreach ($correcto as $correcto1) : ?>
                        <div class="alert alert-<?= $correcto1["tipo"] ?> mt-5"><?= $correcto1["mensaje"] ?></div>
                <?php endforeach;
                } ?>

                <div class="form-group row invisible">
                    <label for="rol" class="col-lg-4 col-form-label text-center">rol: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="rol" name="rol" placeholder="2" value="2" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-lg-4 col-form-label text-center">Nombre: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nombre" name="nombre" <?php if(isset($_POST["nombre"])){echo "value='{$_POST["nombre"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "nombre") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido1" class="col-lg-4 col-form-label text-center">1º Apellido: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="apellido1" name="apellido1" <?php if(isset($_POST["apellido1"])){echo "value='{$_POST["apellido1"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "apellido1") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido2" class="col-lg-4 col-form-label text-center">2º Apellido: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="apellido2" name="apellido2" <?php if(isset($_POST["apellido2"])){echo "value='{$_POST["apellido2"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "apellido2") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nif" class="col-lg-4 col-form-label text-center">NIF: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nif" name="nif" maxlength="9" <?php if(isset($_POST["nif"])){echo "value='{$_POST["nif"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "nif") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="imagen" class="col-lg-4 col-form-label text-center">Imagen: </label>
                    <div class="col-lg-7 ">
                        <input type="file" class="form-control " id="imagen" name="imagen" <?php if(isset($_POST["imagen"])){echo "value='{$_POST["imagen"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "imagen") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-lg-4 col-form-label text-center">Email: </label>
                    <div class="col-lg-7 text-left">
                        <input type="email" class="form-control" id="email" name="email" <?php if(isset($_POST["email"])){echo "value='{$_POST["email"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "email") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="login" class="col-lg-4 col-form-label text-center">Nombre usuario: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="login" name="login" required <?php if(isset($_POST["login"])){echo "value='{$_POST["login"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "login") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="password" class="col-lg-4 col-form-label text-center">Password: </label>
                    <div class="col-lg-7 text-left">
                        <input type="password" class="form-control" id="password" name="password" required <?php if(isset($_POST["password"])){echo "value='{$_POST["password"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "password") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefono" class="col-lg-4 col-form-label text-center">Teléfono: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="telefono" name="telefono" <?php if(isset($_POST["telefono"])){echo "value='{$_POST["telefono"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "telefono") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="direccion" class="col-lg-4 col-form-label text-center">Direccion: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="direccion" name="direccion" <?php if(isset($_POST["direccion"])){echo "value='{$_POST["direccion"]}'";}?> />
                        <?php if (isset($mensajes)) {
                            foreach ($mensajes as $mensaje) :
                                if ($mensaje["campo"] == "direccion") { ?>
                                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php }
                            endforeach;
                        } ?>
                    </div>
                </div>


                <div class="row mt-5">
                    <label class="col-lg-5"></label>
                    <button class="btn btn-secondary btn-lg" type="submit" name="submit">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.container -->