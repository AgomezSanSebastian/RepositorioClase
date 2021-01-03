<div class="container">
    <div class="row mt-5">

        <div class="col-lg-3"></div>

        <div class="col-lg-6 mt-5 mb-5 form_login">
            <form class="form-signin" method="POST" action="?controller=Login&accion=isUser" id="login">
                <?php if (isset($mensajes)) {
                    foreach ($mensajes as $mensaje) : ?>
                        <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                <?php endforeach;
                } ?>
                <div class="form-group row mt-4">
                    <label for="login" class="col-lg-4 col-form-label text-center">Nombre usuario: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="login" name="login" placeholder="" />
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="password" class="col-lg-4 col-form-label text-center">Password: </label>
                    <div class="col-lg-7 text-left">
                        <input type="password" class="form-control" id="password" name="password" placeholder="" />
                    </div>
                </div>
                <div class="row mt-5 text-center">
                    <label class="col-lg-5"></label>
                    <button class="btn btn-secondary btn-lg" type="submit" name="submit">Acceder</button>

                </div>
            </form>
        </div>
    </div>
</div>