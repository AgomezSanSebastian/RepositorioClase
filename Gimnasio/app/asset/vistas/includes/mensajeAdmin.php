<div class="row mt-5">

    <div class="col-lg-12 text-center pt-3">
        <h2>Mandar un mensaje:</h2>
    </div>
    <div class="col-lg-3"></div>
    <div class="col-lg-7 mt-2 mb-5 form_login">
        <form class="form-signin" method="POST" action="?controller=User&accion=AgregarMensajeAdmin" id="mostrarClasesDesdeAdmin">

            <div class="form-group row mt-4">
                <label for="usu_destino" class="col-lg-4 col-form-label text-center">Mensaje para: </label>
                <div class="col-lg-7 text-left">
                    <select class="custom-select form-control" name='usu_destino'>
                        <?php
                        foreach ($datos as $dato) {
                            echo "<option value='{$dato['id']}' id='usu_destino' name='usu_destino'>{$dato['login']}</option>\n";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row mt-4">
                <label for="mensaje" class="col-lg-4 col-form-label text-center">Mensaje a enviar: </label>
                <textarea id="mensaje" name="mensaje" rows="4" class="col-lg-7 form-control col-form-label text-left"></textarea>
            </div>

            <div class="form-group row mt-4 invisible">
                <input type="text" id="usu_origen" name="usu_origen" value="<?= $_SESSION['id'] ?>"></input>
            </div>

            <div class="row mt-5 text-center">
                <label class="col-lg-2"></label>
                <button class="btn btn-secondary btn-lg" type="submit" name="submit" id="submit">Enviar mensaje</button>
                <label class="col-lg-1"></label>
                <button class="btn btn-secondary btn-lg" type="reset" name="reset" id="reset">Borrar mensaje</button>
                <label class="col-lg-1"></label>
                <a class="btn btn-secondary btn-lg" href="?controller=User&accion=VerMensaje&id=<?$_SESSION['id'];?>">Ver mensajes</a>
                <label class="col-lg-1"></label>
            </div>
        </form>
    </div>
</div>