<!-- Page Content -->

<div class="container mb-5">
    <div class="row mt-5">

        <div class="col-lg-3"></div>

        <div class="col-lg-6 form_login mt-5">
            <form class="form-signin" method="POST" action="?controller=Login&accion=registrar" enctype="multipart/form-data">

                <div class="form-group row invisible">
                    <label for="rol" class="col-lg-4 col-form-label text-center">rol: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="rol" name="rol" placeholder="2" value="<?php if (isset($_SESSION['nombre'])) {
                                                                                                                echo $_SESSION['nombre'];
                                                                                                            } else{
                                                                                                                echo '2';
                                                                                                            }
                                                                                                            ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-lg-4 col-form-label text-center">Nombre: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php if (isset($_SESSION['nombre'])) {
                                                                                                        echo $_SESSION['nombre'];
                                                                                                    } ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido1" class="col-lg-4 col-form-label text-center">1º Apellido: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?php if (isset($_SESSION['apellido1'])) {
                                                                                                            echo $_SESSION['apellido1'];
                                                                                                        } ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido2" class="col-lg-4 col-form-label text-center">2º Apellido: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?php if (isset($_SESSION['apellido2'])) {
                                                                                                            echo $_SESSION['apellido2'];
                                                                                                        } ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nif" class="col-lg-4 col-form-label text-center">NIF: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="nif" name="nif" maxlength="9" value="<?php if (isset($_SESSION['nif'])) {
                                                                                                                echo $_SESSION['nif'];
                                                                                                            } ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="imagen" class="col-lg-4 col-form-label text-center">Imagen: </label>
                    <div class="col-lg-7 ">                        
                        <input type="file" class="form-control " id="imagen" name="imagen" value="<?php if (isset($_SESSION['imagen'])) {
                                                                                                                echo $_SESSION['imagen'];
                                                                                                            } ?>" />/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-lg-4 col-form-label text-center">Email: </label>
                    <div class="col-lg-7 text-left">
                        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($_SESSION['email'])) {
                                                                                                    echo $_SESSION['email'];
                                                                                                } ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="login" class="col-lg-4 col-form-label text-center">Nombre usuario: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="login" name="login" required value="<?php if (isset($_SESSION['login'])) {
                                                                                                            echo $_SESSION['login'];
                                                                                                        } ?>" />
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="password" class="col-lg-4 col-form-label text-center">Password: </label>
                    <div class="col-lg-7 text-left">
                        <input type="password" class="form-control" id="password" name="password" required value="<?php if (isset($_SESSION['password'])) {
                                                                                                                        echo $_SESSION['password'];
                                                                                                                    } ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefono" class="col-lg-4 col-form-label text-center">Teléfono: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php if (isset($_SESSION['telefono'])) {
                                                                                                            echo $_SESSION['telefono'];
                                                                                                        } ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="direccion" class="col-lg-4 col-form-label text-center">Direccion: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php if (isset($_SESSION['direccion'])) {
                                                                                                            echo $_SESSION['direccion'];
                                                                                                        } ?>" />
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