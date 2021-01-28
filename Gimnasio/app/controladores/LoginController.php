<?php

/**
 * Controlador de la página login desde la que se puede hacer a la página del usuario
 */

/**
 * Incluimos todos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->modelo = new UserModel();
        $this->mensajes = [];
    }

    public function index()
    {
        $parametros = [
            "tituloventana" => "Login a la aplicación"
        ];
        $this->view->show("Login", $parametros);
    }

    /**
     * Método que comprueba que el usuario se loguea correctamente siempre que tenga cuenta, 
     * si no la tiene daría un error
     */
    public function isUser()
    {
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();

        //Si se ha pulsado el boton de enviar...
        if (isset($_POST['submit'])) {

            //Si usuario o password estan vacios...
            if (empty($_POST['login']) || empty($_POST['password'])) {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "No puede dejar algún campo en blanco."
                ];
                $parametros["mensajes"] = $this->mensajes;

                $this->view->show("Login", $parametros);
            } else {
                $login = $_POST['login'];
                $password = sha1($_POST['password']);

                //Preguntamos por el usuario y contraseña a la bbdd para saber si son correcto o no
                $resultado = $this->modelo->isUser([
                    'login' => $login,
                    'password' => $password
                ]);

                if ($resultado['correcto']) {
                    //Preguntamos si el usuario esta validado pasando su nombre de usuario.
                    $datos = $this->modelo->userActivado($login);

                    //Se crea sesión del usuario
                    $_SESSION['login'] = $login;
                    //Guardamos su id y rol.
                    $_SESSION['id'] = $datos['datos']['id'];
                    $_SESSION['rol'] = $datos['datos']['rol'];


                    //Si el rol es diferente a 2, sigue adelante. El 2 falta por activarlo.
                    if ($_SESSION['rol'] != 2) {

                        //Si el usuario y contraseña son correctos:
                        if ($resultado['correcto'] == TRUE) {

                            //Implementación de la funcion recuerdame que guarda en usuario y contraseña en cookies. 
                             if (isset($_POST['recuerdo']) && ($_POST['recuerdo'] == "on")) { // Creamos las cookies para ambas variables
                             setcookie('login', $login, time() + (15 * 24 * 60 * 60));
                             setcookie('password', $_POST['password'], time() + (15 * 24 * 60 * 60));
                             setcookie('recuerdo', $_POST['recuerdo'], time() + (15 * 24 * 60 * 60));
                         } else { // Eliminamos las cookies vaciandolas
                             if (isset($_COOKIE['login'])) {
                                 setcookie('login', "");
                             }
                             if (isset($_COOKIE['password'])) {
                                 setcookie('password', "");
                             }
                             if (isset($_COOKIE['recuerdo'])) {
                                 setcookie('recuerdo', "");
                             }
                         }

                            $parametros['datos'] = $resultado['datos'];
                            //Actualizamos las variables de sesion con toda la informacion del usuario.
                            $_SESSION['nif'] = $parametros['datos'][0]['nif'];
                            $_SESSION['nombre'] = $parametros['datos'][0]['nombre'];
                            $_SESSION['apellido1'] = $parametros['datos'][0]['apellido1'];
                            $_SESSION['apellido2'] = $parametros['datos'][0]['apellido2'];
                            $_SESSION['email'] = $parametros['datos'][0]['email'];
                            $_SESSION['telefono'] = $parametros['datos'][0]['telefono'];
                            $_SESSION['direccion'] = $parametros['datos'][0]['direccion'];
                            $_SESSION['imagen'] = $parametros['datos'][0]['imagen'];
                            $_SESSION['password'] = $parametros['datos'][0]['password'];

                            //Discriminamos entre roles para dar paso a una u otra parte de la pagina.
                            if ($_SESSION['rol'] == 0) {
                                $this->view->show("homeAdmin", $parametros);
                            }
                            if ($_SESSION['rol'] == 1) {
                                $this->view->show("homeUsuario", $parametros);
                            }

                            //Si el usuario y contraseña NO son correctos:
                        } else {
                            $this->mensajes[] = [
                                "tipo" => "danger",
                                "mensaje" => "Usuario o contraseña incorrectos"
                            ];
                            $parametros["mensajes"] = $this->mensajes;

                            $this->view->show("Login", $parametros);
                        }
                        //Si el usuario no esta validado.
                    } else {
                        $this->mensajes[] = [
                            "tipo" => "warning",
                            "mensaje" => "Usuario no está activado aún, espere que el administrador lo active."
                        ];
                        $parametros["mensajes"] = $this->mensajes;

                        $this->view->show("Login", $parametros);
                    }
                } else {
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "Usuario o contraseña incorrectos"
                    ];
                    $parametros["mensajes"] = $this->mensajes;

                    $this->view->show("Login", $parametros);
                }
            }
        //Si no se ha pulsado dl boton de submit:   
        } else {
            $this->view->show("Login");
        }
    }

    public function registrar()
    {

        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();

        // Si se ha pulsado el botón guardar...
        if (isset($_POST) && !empty($_POST) && isset($_POST['submit'])) { // y hemos recibido las variables del formulario y éstas no están vacías...
            //Sanitizamos los valores que nos llegan
            $nif = filter_var($_POST['nif'], FILTER_SANITIZE_STRING);
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $apellido1 = filter_var($_POST['apellido1'], FILTER_SANITIZE_STRING);
            $apellido2 = filter_var($_POST['apellido2'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
            $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
            $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
            $password = sha1($_POST['password']);
            $rol = $_POST['rol'];

            /* Realizamos la carga de la imagen en el servidor */
            // Comprobamos que el campo tmp_name tiene un valor asignado para asegurar que hemos
            // recibido la imagen correctamente
            // Definimos la variable $imagen que almacenará el nombre de imagen
            // que almacenará la Base de Datos inicializada a NULL
            $imagen = null;

            if (isset($_FILES["imagen"]) && (!empty($_FILES["imagen"]["tmp_name"]))) {
                // Verificamos la carga de la imagen
                // Comprobamos si existe el directorio fotos, y si no, lo creamos
                if (!is_dir("fotos")) {
                    $dir = mkdir("fotos", 0777, true);
                } else {
                    $dir = true;
                }
                // Ya verificado que la carpeta uploads existe movemos el fichero seleccionado a dicha carpeta
                if ($dir) {
                    //Para asegurarnos que el nombre va a ser único...
                    $nombrefichimg = $_FILES["imagen"]["name"];
                    // Movemos el fichero de la carpeta temportal a la nuestra
                    $movfichimg = move_uploaded_file($_FILES["imagen"]["tmp_name"], "fotos/" . $nombrefichimg);
                    $imagen = $nombrefichimg;

                    // Verficamos que la carga se ha realizado correctamente
                    if ($movfichimg) {
                        $imagencargada = true;
                    } else {
                        $imagencargada = false;
                        $this->mensajes[] = [
                            "tipo" => "danger",
                            "mensaje" => "Error: La imagen no se cargó correctamente! :("
                        ];
                        $errores["imagen"] = "Error: La imagen no se cargó correctamente! :(";
                    }
                }
            }

            //Si no se cumple la expresión regular se genera un error especifico.
            if (!preg_match("/^\d{8}[a-zA-Z]{1}$/", $nif)) {
                $this->mensajes[] = [
                    "campo" => "nif",
                    "tipo" => "danger",
                    "mensaje" => "NIF no valido."
                ];
                $errores["nif"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/^[a-zA-Z]{1,50}$/", $nombre)) {
                $this->mensajes[] = [
                    "campo" => "nombre",
                    "tipo" => "danger",
                    "mensaje" => "Nombre no valido."
                ];
                $errores["nombre"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/^[a-zA-Z]{1,50}$/", $apellido1)) {
                $this->mensajes[] = [
                    "campo" => "apellido1",
                    "tipo" => "danger",
                    "mensaje" => "Apellido no valido."
                ];
                $errores["apellido1"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/^[a-zA-Z]{1,50}$/", $apellido2)) {
                $this->mensajes[] = [
                    "campo" => "apellido2",
                    "tipo" => "danger",
                    "mensaje" => "Apellido no valido."
                ];
                $errores["apellido2"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/^[a-zA-Z0-9]{1,50}$/", $login)) {
                $this->mensajes[] = [
                    "campo" => "login",
                    "tipo" => "danger",
                    "mensaje" => "Login no valido."
                ];
                $errores["login"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/^[6-9]{1}[0-9]{8}$/", $telefono)) {
                $this->mensajes[] = [
                    "campo" => "telefono",
                    "tipo" => "danger",
                    "mensaje" => "Número no valido."
                ];
                $errores["telefono"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/[a-zA-Z0-9_-]{1,200}/", $direccion)) {
                $this->mensajes[] = [
                    "campo" => "direccion",
                    "tipo" => "danger",
                    "mensaje" => "Caracter no valido. Prueba con un guión - ó _ "
                ];
                $errores["direccion"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            //Hay errores 
            if (count($errores) > 0) {
                $this->view->show("Registro", $parametros);
            }

            // Si no se han producido errores realizamos el registro del usuario
            if (count($errores) == 0) {
                $resultModelo = $this->modelo->adduser([
                    'nif' => $nif,
                    'nombre' => $nombre,
                    'apellido1' => $apellido1,
                    'apellido2' => $apellido2,
                    'imagen' => $imagen,
                    'login' => $login,
                    'password' => $password,
                    'email' => $email,
                    'telefono' => $telefono,
                    'direccion' => $direccion,
                    'rol' => $rol
                ]);
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "El usuarios se registró correctamente!! ESPERA A QUE UN ADMIN TE VALIDE :)"
                    ];
                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "El usuario no pudo registrarse!! :( <br />({$resultModelo["error"]})"
                    ];
                endif;
                //$parametros = ["mensajes" => $this->mensajes];
                //$this->view->show("Registro", $parametros);
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
                //$parametros = ["mensajes" => $this->mensajes];
            }
        }

        //Preparamos un array con todos los valores que tendremos que rellenar en
        //la vista adduser: título de la página y campos del formulario
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => [
                'nif' => $nif,
                'nombre' => $nombre,
                'apellido1' => $apellido1,
                'apellido2' => $apellido2,
                'imagen' => $imagen,
                'login' => $login,
                'password' => $password,
                'email' => $email,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'rol' => $rol
            ],
            "mensajes" => $this->mensajes,

        ];
        //Mostramos la vista actuser
        $this->view->show("Registro", $parametros);
    }
}
