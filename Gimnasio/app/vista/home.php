<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Gimnasio Adrian DAW2</title>

    <!-- Bootstrap core CSS -->
    <link href="../asset/bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../asset/bootstrap/css/shop-homepage.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="../asset/bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="../asset/bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link href="../asset/css/estilo.css" rel="stylesheet">
</head>

<body>

    <?php

    include "include/nav.php";

    $page = $_GET['page'];

    switch ($page) {
        case 'login':
            include "login.php";
            break;
        case 'registro':
            include "registro.php";
            break;
        case 'horario':
            include "horario.php";
            break;
        case 'listaActividades':
            include "listaActividades.php";
            break;
        case 'listaUsuario':
            include "listaUsuario.php";
            break;
        case 'mensaje':
            include "mensaje.php";
            break;
    }

    include "include/footer.php";

    ?>


</body>