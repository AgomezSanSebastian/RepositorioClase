<div class="row mt-5">

    <div class="col-lg-12 text-center pt-3">
        <h2>Listar mensajes recibidos:</h2>
    </div>

    <!--Creamos la tabla que utilizaremos para el listado:-->

    <div class="col-lg-2"></div>
    <div class="col-lg-8 mb-5 form_login">
        <div class="form-group row mt-4">
        <?php foreach ($datos as $dato) : ?>
            <label for="mensaje" class="col-lg-4 col-form-label text-center">Mensaje enviado por: <?=$dato['login'];?> </label>
            <textarea id="mensaje" name="mensaje" rows="4" class="col-lg-6 mb-5 form-control col-form-label text-left" readonly><?=$dato['mensaje'];?></textarea>
            <?php endforeach; ?>
        </div>
        
        <div class="col-lg-12 mt-5 text-center">
            <a class="btn btn-secondary btn-lg" href="?controller=User&accion=cargarMensajeUser">Volver hacia atrás</a>
        </div>
    </div>


    
