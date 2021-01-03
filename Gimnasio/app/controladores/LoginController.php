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
                // $password = sha1($_POST['password']);
                $password = $_POST['password'];

                //Preguntamos por el usuario y contraseña a la bbdd para saber si son correcto o no
                $resultado = $this->modelo->isUser([
                    'login' => $login,
                    'password' => $password
                ]);

                //Se crea sesión del usuario
                $_SESSION['login'] = $login;

                //Preguntamos si el usuario esta validado pasando su nombre de usuario.
                $datos = $this->modelo->userActivado($login);

                //Guardamos su id y rol.
                $_SESSION['id'] = $datos['datos']['id'];
                $_SESSION['rol'] = $datos['datos']['rol'];


                //Si el rol es diferente a 2, sigue adelante. El 2 falta por activarlo.
                if ($_SESSION['rol'] != 2) {

                    //Si el usuario y contraseña son correctos:
                    if ($resultado['correcto'] == TRUE) {

                        //Implementación de la funcion recuerdame que guarda en usuario y contraseña en cookies. 
                        /* if (isset($_POST['recuerdo']) && ($_POST['recuerdo'] == "on")) { // Creamos las cookies para ambas variables
                             setcookie('usuario', $usuario, time() + (15 * 24 * 60 * 60));
                             setcookie('password', $_POST['txtpassword'], time() + (15 * 24 * 60 * 60));
                             setcookie('recuerdo', $_POST['recuerdo'], time() + (15 * 24 * 60 * 60));
                         } else { // Eliminamos las cookies vaciandolas
                             if (isset($_COOKIE['usuario'])) {
                                 setcookie('usuario', "");
                             }
                             if (isset($_COOKIE['password'])) {
                                 setcookie('password', "");
                             }
                             if (isset($_COOKIE['recuerdo'])) {
                                 setcookie('recuerdo', "");
                             }
                         }*/

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
            }



            //Si no se ha pulsado dl boton de submit:   
        } else {
            $this->view->show("Login");
        }
    }

    public function registrar() {
        
    }
}
