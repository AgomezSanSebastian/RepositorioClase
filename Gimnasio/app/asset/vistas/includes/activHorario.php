<div class="row mt-5">

    <div class="col-lg-3"></div>

    <div class="col-lg-6 mt-5 mb-5 form_login">
        <form class="form-signin" method="POST" action="?controller=User&accion=guardarActivHorario" id="guardarActivHorario">

            <div class="form-group row mt-4">
                <label for="nombre" class="col-lg-4 col-form-label text-center">Nombre actividad: </label>
                <div class="col-lg-7 text-left">
                    <select class="custom-select form-control" name='nombre'>
                        <?php
                        foreach ($datos as $dato) {
                            echo "<option value='{$dato['id']}'id='nombre'>{$dato['nombre']}</option>\n";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row mt-4">
                <label for="dia" class="col-lg-4 col-form-label text-center">Día: </label>
                <div class="col-lg-7 text-left">
                    <input type="text" class="form-control" id="dia" name="dia" value="<?=$dia?>" readonly />
                </div>
            </div>

            <div class="form-group row mt-4">
                <label for="hora" class="col-lg-4 col-form-label text-center">Hora: </label>
                <div class="col-lg-7 text-left">
                    <input type="text" class="form-control" id="hora" name="hora" value="<?=$hora?>" readonly   />
                </div>
            </div>            
            
            <div class="form-group row mt-4">
                <label for="fecha_alta" class="col-lg-4 col-form-label text-center">Alta: </label>
                <div class="col-lg-7 text-left">
                    <input type="text" class="form-control" id="fecha_alta" name="fecha_alta" value="<?=$alta = date("Y-m-d");?>" readonly />
                </div>
            </div>

            <div class="row mt-5 text-center">
                <label class="col-lg-5"></label>
                <button class="btn btn-secondary btn-lg" type="submit" name="submit" id="submit">Agregar</button>
            </div>

        </form>
    </div>
</div>