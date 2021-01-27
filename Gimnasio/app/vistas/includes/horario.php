<div class="container-fluid mt-5">
    <div class="text-center pt-3">
        <h2>HORARIO del gimnasio:</h2>
    </div>
    <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
    <?php if (isset($mensajes)) {
        foreach ($mensajes as $mensaje) : ?>
            <div class="alert alert-<?= $mensaje["tipo"] ?> mt-5"><?= $mensaje["mensaje"] ?></div>
    <?php endforeach;
    } ?>
    <!--Creamos la tabla que utilizaremos para el listado:-->
    <?php
    $horas = ["9:00", "10:00", "11:00", "12:00", "13:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00"];
    $dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];

    ?>
    <table class="table table-striped text-center">
        <tr>
            <th>Hora</th>
            <?php foreach ($dias as $dia) : ?>
                <th><?= $dia ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($horas as $hora) :  ?>

            <tr>
                <td><?= $hora ?> </td>

                <td>
                    <?php
                    foreach ($datos as $dato) :
                    ?>
                        <?php if ($dias[0] == $dato["dia"] && $hora == $dato["inicio"]) {
                            echo $dato["nombre"];
                        ?> <a href="?controller=user&accion=inscribirseActiv&activ=<?=$dato['id']?>&user=<?=$_SESSION['id']?>&dia=<?=$dato['dia']?>&inicio=<?=$dato['inicio']?>">Apuntarse</a>
                        <?php } ?>
                    <?php
                    endforeach;
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($datos as $dato) :
                    ?>
                        <?php if ($dias[1] == $dato["dia"] && $hora == $dato["inicio"]) {
                            echo $dato["nombre"];
                            ?> <a href="?controller=user&accion=inscribirseActiv&activ=<?=$dato['id']?>&user=<?=$_SESSION['id']?>&dia=<?=$dato['dia']?>&inicio=<?=$dato['inicio']?>">Apuntarse</a>
                        <?php } ?>
                    <?php
                    endforeach;
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($datos as $dato) :
                    ?>
                        <?php if ($dias[2] == $dato["dia"] && $hora == $dato["inicio"]) {
                            echo $dato["nombre"];
                            ?> <a href="?controller=user&accion=inscribirseActiv&activ=<?=$dato['id']?>&user=<?=$_SESSION['id']?>&dia=<?=$dato['dia']?>&inicio=<?=$dato['inicio']?>">Apuntarse</a>
                        <?php } ?>
                    <?php
                    endforeach;
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($datos as $dato) :
                    ?>
                        <?php if ($dias[3] == $dato["dia"] && $hora == $dato["inicio"]) {
                            echo $dato["nombre"];
                            ?> <a href="?controller=user&accion=inscribirseActiv&activ=<?=$dato['id']?>&user=<?=$_SESSION['id']?>&dia=<?=$dato['dia']?>&inicio=<?=$dato['inicio']?>">Apuntarse</a>
                        <?php } ?>
                    <?php
                    endforeach;
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($datos as $dato) :
                    ?>
                        <?php if ($dias[4] == $dato["dia"] && $hora == $dato["inicio"]) {
                            echo $dato["nombre"];
                            ?> <a href="?controller=user&accion=inscribirseActiv&activ=<?=$dato['id']?>&user=<?=$_SESSION['id']?>&dia=<?=$dato['dia']?>&inicio=<?=$dato['inicio']?>">Apuntarse</a>
                        <?php } ?>
                    <?php
                    endforeach;
                    ?>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
</div>