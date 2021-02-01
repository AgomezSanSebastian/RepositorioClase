<?php

/**
 * Controlador de la página login desde la que se puede hacer a la página del usuario
 */

/**
 * Incluimos todos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->modelo = new UserModel();
        $this->mensajes = [];
    }

    /**
     * Funcion para cerrar sesion y volver al principio
     */
    public function recargarAdmin()
    {
        session_destroy();
        $this->view->show("HomeAdmin");
    }

    /**
     * Funcion para cerrar sesion y volver al principio
     */
    public function recargarUser()
    {
        session_destroy();
        $this->view->show("Inicio");
    }

    /**
     * Recarga la página inicial por parte del usuario
     */
    public function homeUsuario()
    {
        $parametros = [
            "tituloventana" => "Login a la aplicación"
        ];
        $this->view->show("HomeUsuario", $parametros);
    }

    /**
     * Recarga la página inicial por parte del administrador
     */
    public function homeAdmin()
    {
        $parametros = [
            "tituloventana" => "Login a la aplicación"
        ];
        $this->view->show("HomeAdmin", $parametros);
    }

    /**
     * Funcion para cerrar sesion y volver al principio
     */
    public function cerrarSesion()
    {
        session_destroy();
        $this->view->show("Inicio");
    }

        
    /**
     * Lista todos los usuario de la BD
     *
     * @return void
     */
    public function listarUser()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => [],
            "totalregistros" => NULL,
            "pagina" => NULL,
            "numpaginas" => NULL
        ];
        //Empezamos con la paginación
        //Establecemos el número de registros a mostrar por página,por defecto 2
        $regsxpag = (isset($_GET['regsxpag'])) ? (int)$_GET['regsxpag'] : 2;
        //Establecemos la página que vamos a mostrar, por página,por defecto la 1
        $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
        $totalregistros = null;


        //Definimos la variable $inicio que indique la posición del registro desde el que se
        // mostrarán los registros de una página dentro de la paginación.
        $offset = ($pagina > 1) ? (($pagina - 1) * $regsxpag) : 0;
        //SQL_CALC_FOUND_ROWS está siendo depreciado en MySQL
        //Vamos a usar COUNT en su lugar
        //Calculamos el número de registros obtenidos

        $resultPaginar = $this->modelo->paginarUsuarios($regsxpag, $offset);
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultPaginar["correcto"]) :
            $parametros["datos"] = $resultPaginar["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];

            $parametros["totalregistros"] = $resultPaginar["totalregistros"];
            $totalregistros = $resultPaginar["totalregistros"];

            //Determinamos el número de páginas de la que constará mi paginación
            $parametros["numpaginas"] = ceil($totalregistros / $regsxpag);
            $parametros["pagina"] = $pagina;
            $parametros["regsxpag"] = $regsxpag;

        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultPaginar["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("ListarUsuarios", $parametros);
    }

    
    /**
     * Método para buscar cualquier coincidencia en la BD por parte de la tabla usuarios
     *
     * @return void
     */
    public function buscar()
    {
         // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
         $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => [],
            "totalregistros" => NULL,
            "pagina" => NULL,
            "numpaginas" => NULL
        ];
        //Empezamos con la paginación
        //Establecemos el número de registros a mostrar por página,por defecto 2
        $regsxpag = (isset($_GET['regsxpag'])) ? (int)$_GET['regsxpag'] : 2;
        //Establecemos la página que vamos a mostrar, por página,por defecto la 1
        $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
        $totalregistros = null;
        $palabra = $_POST['nombre'];


        //Definimos la variable $inicio que indique la posición del registro desde el que se
        // mostrarán los registros de una página dentro de la paginación.
        $offset = ($pagina > 1) ? (($pagina - 1) * $regsxpag) : 0;
        //SQL_CALC_FOUND_ROWS está siendo depreciado en MySQL
        //Vamos a usar COUNT en su lugar
        //Calculamos el número de registros obtenidos

        $resultPaginar = $this->modelo->paginarUsuariosBuscar($regsxpag, $offset,$palabra);
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultPaginar["correcto"]) :
            $parametros["datos"] = $resultPaginar["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];

            $parametros["totalregistros"] = $resultPaginar["totalregistros"];
            $totalregistros = $resultPaginar["totalregistros"];

            //Determinamos el número de páginas de la que constará mi paginación
            $parametros["numpaginas"] = ceil($totalregistros / $regsxpag);
            $parametros["pagina"] = $pagina;
            $parametros["regsxpag"] = $regsxpag;

        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultPaginar["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("ListarUsuarios", $parametros);
    }

        
    /**
     * Lista los usuario no activados aún
     *
     * @return void
     */
    public function listarNoActivos()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => []
        ];
        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->faltaPorActivar();
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error        
        $this->view->show("ListarNoActivos", $parametros);
    }


        
    /**
     * Cambia el rol de un usuario en concreto de los no activado 
     *
     * @return void
     */
    public function cambiarRol()
    {

        $datos = [];
        //Cogemos el id del usuario a cambiar y el nuevo rol
        $datos['id'] = $_GET['id'];
        $datos['rol'] = $_GET['rol'];

        //Llamamos al modelo
        $this->modelo->cambiarRolUser($datos);
        //Recargamos la página
        $this->ListarNoActivos();
    }

        
    /**
     * Cambia el rol un usuario en concreto
     *
     * @return void
     */
    public function cambiarRolActivos()
    {

        $datos = [];
        //Cogemos el id del usuario a cambiar y el nuevo rol
        $datos['id'] = $_GET['id'];
        $datos['rol'] = $_GET['rol'];

        //Llamamos al modelo
        $this->modelo->cambiarRolUser($datos);
        //Recargamos la página
        $this->listarUser();
    }

    
    /**
     * Carga la ventana de editar usuario
     *
     * @return void
     */
    public function editarUsuario()
    {
        $parametros = [
            "tituloventana" => "Editar usuario a la aplicación"
        ];
        $this->view->show("EditarUsuario", $parametros);
    }


    /**
     * DEBERÍA COMPRABAR POR SI SE BORRA
     */
    public function ediUsuario()
    {
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();

        $valnombre = "";
        $valemail  = "";
        $valnif = "";
        $valapellido1 = "";
        $valapellido2 = "";
        $valtelefono = "";
        $valdireccion = "";
        $valpassword = "";
        $id = $_GET['id'];
        $nuevaimagen = "";

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
            $password = sha1($_POST['password']);
            $id = $_POST['id'];

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

            $nuevaimagen = $imagen;

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
                $this->view->show("EditarUsuario", $parametros);
            }

            // Si no se han producido errores realizamos el registro del usuario
            if (count($errores) == 0) {
                $resultModelo = $this->modelo->actuser([
                    'id' => $id,
                    'nif' => $nif,
                    'nombre' => $nombre,
                    'apellido1' => $apellido1,
                    'apellido2' => $apellido2,
                    'imagen' => $nuevaimagen,
                    'password' => $password,
                    'email' => $email,
                    'telefono' => $telefono,
                    'direccion' => $direccion
                ]);
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "El usuarios se actualizó correctamente!! :)"
                    ];
                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "El usuario no pudo actualizarse!! :( <br />({$resultModelo["error"]})"
                    ];
                endif;

                //$this->view->show("EditarUsuario");
                // Obtenemos los valores para mostrarlos en los campos del formulario
                $valnombre = $nombre;
                $valemail  = $email;
                $valimagen = $nuevaimagen;
                $valnif = $nif;
                $valapellido1 = $apellido1;
                $valapellido2 = $apellido2;
                $valtelefono = $telefono;
                $valdireccion = $direccion;
                $valpassword = $password;
                $valid = $id;
            } else {

                if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
                    $id = $_GET['id'];

                    //Ejecutamos la consulta para obtener los datos del usuario #id
                    $resultModelo = $this->modelo->listausuario($id);
                    //Analizamos si la consulta se realiz´correctamente o no y generamos un
                    //mensaje indicativo
                    if ($resultModelo["correcto"]) :
                        $this->mensajes[] = [
                            "tipo" => "success",
                            "mensaje" => "Los datos del usuario se obtuvieron correctamente!! :)"
                        ];
                        $valnombre = $resultModelo["datos"]["nombre"];
                        $valemail  = $resultModelo["datos"]["email"];
                        $valimagen = $resultModelo["datos"]["imagen"];
                        $valnif = $resultModelo["datos"]["nif"];;
                        $valapellido1 = $resultModelo["datos"]["apellido1"];
                        $valapellido2 = $resultModelo["datos"]["apellido2"];
                        $valtelefono = $resultModelo["datos"]["telefono"];
                        $valdireccion = $resultModelo["datos"]["direccion"];
                        $valpassword = $resultModelo["datos"]["password"];
                        $valid = $resultModelo["datos"]["id"];
                    else :
                        $this->mensajes[] = [
                            "tipo" => "danger",
                            "mensaje" => "No se pudieron obtener los datos de usuario!! :( <br/>({$resultModelo["error"]})"
                        ];
                    endif;
                }
            }
        }
        //Preparamos un array con todos los valores que tendremos que rellenar en
        //la vista adduser: título de la página y campos del formulario
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => [
                'id' => $valid,
                'nif' => $valnif,
                'nombre' => $valnombre,
                'apellido1' => $valapellido1,
                'apellido2' => $valapellido2,
                'imagen' => $nuevaimagen,
                'password' => $valpassword,
                'email' => $valemail,
                'telefono' => $valtelefono,
                'direccion' => $valdireccion
            ],
            "mensajes" => $this->mensajes,
            "id" => $id
        ];
        //Mostramos la vista actuser
        $this->view->show("EditarUsuario", $parametros);
    }

    //---------------------------------------------------------------------------------------------    
    /**
     * Método que edita un usuario en concreto
     *
     * @return void
     */
    public function editarUser1()
    {
        /**
         * Método de la clase controlador que permite actualizar los datos del usuario
         * cuyo id coincide con el que se pasa como parámetro desde la vista de listado
         * a través de GET
         */
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();
        // Inicializamos valores de los campos de texto
        $valnif = "";
        $valnombre = "";
        $valape1 = "";
        $valape2 = "";
        $valemail = "";
        $valtele = "";
        $valdire = "";
        $valpass = "";
        $id = $_GET['id'];


        // Si se ha pulsado el botón actualizar...
        if (isset($_POST['submit'])) { //Realizamos la actualización con los datos existentes en los campos
            //$id = $_POST['id']; //Lo recibimos por el campo oculto
            $newnif = filter_var($_POST['nif'], FILTER_SANITIZE_STRING);
            $newnombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $newape1  = filter_var($_POST['apellido1'], FILTER_SANITIZE_STRING);
            $newape2 = filter_var($_POST['apellido2'], FILTER_SANITIZE_STRING);
            $newemail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $newtele = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
            $newdire = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
            $newpass = sha1($_POST['password']);


            if (count($errores) == 0) {
                //Ejecutamos la instrucción de actualización a la que le pasamos los valores
                $resultModelo = $this->modelo->actuser([
                    'id' => $id,
                    'nif' => $newnif,
                    'nombre' => $newnombre,
                    'apellido1' => $newape1,
                    'apellido2' => $newape2,
                    'email' => $newemail,
                    'telefono' => $newtele,
                    'direccion' => $newdire,
                    'password' => $newpass,
                ]);
                //Analizamos cómo finalizó la operación de registro y generamos un mensaje
                //indicativo del estado correspondiente
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "El usuario se actualizó correctamente!! :)"
                    ];
                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "El usuario no pudo actualizarse!! :( <br/>({$resultModelo["error"]})"
                    ];
                endif;
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
            }

            // Obtenemos los valores para mostrarlos en los campos del formulario
            $valnombre = $newnombre;
            $valape2  = $newape2;
            $valdire = $newdire;
            $valnif = $newnif;
            $valape1 = $newape1;
            $valemail = $newemail;
            $valtele = $newtele;
            $valpass = $newpass;
        } else { //Estamos rellenando los campos con los valores recibidos del listado
            if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
                $id = $_GET['id'];
                //Ejecutamos la consulta para obtener los datos del usuario #id
                $resultModelo = $this->modelo->listaUsuario($id);
                //Analizamos si la consulta se realiz´correctamente o no y generamos un
                //mensaje indicativo
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "Los datos del usuario se obtuvieron correctamente!! :)"
                    ];
                    $id = $resultModelo["datos"]["id"];
                    $valnif = $resultModelo["datos"]["nif"];
                    $valnombre = $resultModelo["datos"]["nombre"];
                    $valape1 = $resultModelo["datos"]["apellido1"];
                    $valape2 = $resultModelo["datos"]["apellido2"];
                    $valemail = $resultModelo["datos"]["email"];
                    $valtele = $resultModelo["datos"]["telefono"];
                    $valdire = $resultModelo["datos"]["direccion"];
                    $valpass = $resultModelo["datos"]["password"];

                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "No se pudieron obtener los datos de activiadades!! :( <br/>({$resultModelo["error"]})"
                    ];
                endif;
            }
        }
        //Preparamos un array con todos los valores que tendremos que rellenar en
        //la vista adduser: título de la página y campos del formulario
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => [

                'id' => $id,
                'nif' => $valnif,
                'nombre' => $valnombre,
                'apellido1' => $valape1,
                'apellido2' => $valape2,
                'email' => $valemail,
                'telefono' => $valtele,
                'direccion' => $valdire,
                'password' => $valpass,
            ],
            "mensajes" => $this->mensajes,
            "id" => $id
        ];
        //Mostramos la vista actuser
        $this->view->show("EditarUsuario", $parametros);
    }

        
    /**
     * Método que borra un usuario en concreto
     *
     * @return void
     */
    public function deluser()
    {
        // verificamos que hemos recibido los parámetros desde la vista de listado 
        if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
            $id = $_GET["id"];
            //Realizamos la operación de suprimir el usuario con el id=$id
            $resultModelo = $this->modelo->deluser($id);
            //Analizamos el valor devuelto por el modelo para definir el mensaje a 
            //mostrar en la vista listado
            if ($resultModelo["correcto"]) :
                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Se eliminó correctamente el usuario $id"
                ];
            else :
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "La eliminación del usuario no se realizó correctamente!! :( <br/>({$resultModelo["error"]})"
                ];
            endif;
        } else { //Si no recibimos el valor del parámetro $id generamos el mensaje indicativo:
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "No se pudo acceder al id del usuario a eliminar!! :("
            ];
        }
        //Realizamos el listado de los usuarios
        $this->listarUser();
    }


       
    /**
     * Método que edita el perfil de un usuario por parte de ese mismo usuario
     *
     * @return void
     */
    public function editarPerfil()
    {
        /**
         * Método de la clase controlador que permite actualizar los datos del usuario
         * cuyo id coincide con el que se pasa como parámetro desde la vista de listado
         * a través de GET
         */
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();
        // Inicializamos valores de los campos de texto
        $valnif = "";
        $valnombre = "";
        $valape1 = "";
        $valape2 = "";
        $valemail = "";
        $valtele = "";
        $valdire = "";
        $valpass = "";
        $valid = "";
        $login = $_GET['login'];


        // Si se ha pulsado el botón actualizar...
        if (isset($_POST['submit'])) { //Realizamos la actualización con los datos existentes en los campos

            $newnif = filter_var($_POST['nif'], FILTER_SANITIZE_STRING);
            $newnombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $newape1  = filter_var($_POST['apellido1'], FILTER_SANITIZE_STRING);
            $newape2 = filter_var($_POST['apellido2'], FILTER_SANITIZE_STRING);
            $newemail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $newtele = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
            $newdire = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
            $newpass = sha1($_POST['password']);
            $newid = $_POST['id'];


            if (count($errores) == 0) {
                //Ejecutamos la instrucción de actualización a la que le pasamos los valores
                $resultModelo = $this->modelo->actuser([
                    'id' => $newid,
                    'nif' => $newnif,
                    'nombre' => $newnombre,
                    'apellido1' => $newape1,
                    'apellido2' => $newape2,
                    'email' => $newemail,
                    'telefono' => $newtele,
                    'direccion' => $newdire,
                    'password' => $newpass,
                ]);
                //Analizamos cómo finalizó la operación de registro y generamos un mensaje
                //indicativo del estado correspondiente
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "El usuario se actualizó correctamente!! :)"
                    ];
                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "El usuario no pudo actualizarse!! :( <br/>({$resultModelo["error"]})"
                    ];
                endif;
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
            }

            // Obtenemos los valores para mostrarlos en los campos del formulario
            $valid = $newid;
            $valnombre = $newnombre;
            $valape1 = $newape1;
            $valape2  = $newape2;
            $valnif = $newnif;
            $valdire = $newdire;
            $valemail = $newemail;
            $valtele = $newtele;
            $valpass = $newpass;
        } else { //Estamos rellenando los campos con los valores recibidos del listado
            if (isset($_GET['login'])) {
                $login = $_GET['login'];
                //Ejecutamos la consulta para obtener los datos del usuario #id
                $resultModelo = $this->modelo->buscarPerfil($login);
                //Analizamos si la consulta se realiz´correctamente o no y generamos un
                //mensaje indicativo
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "Los datos del usuario se obtuvieron correctamente!! :)"
                    ];
                    $valid = $resultModelo["datos"]["id"];
                    $valnif = $resultModelo["datos"]["nif"];
                    $valnombre = $resultModelo["datos"]["nombre"];
                    $valape1 = $resultModelo["datos"]["apellido1"];
                    $valape2 = $resultModelo["datos"]["apellido2"];
                    $valemail = $resultModelo["datos"]["email"];
                    $valtele = $resultModelo["datos"]["telefono"];
                    $valdire = $resultModelo["datos"]["direccion"];
                    $valpass = $resultModelo["datos"]["password"];

                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "No se pudieron obtener los datos de activiadades!! :( <br/>({$resultModelo["error"]})"
                    ];
                endif;
            }
        }
        //Preparamos un array con todos los valores que tendremos que rellenar en
        //la vista adduser: título de la página y campos del formulario
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => [

                'id' => $valid,
                'nif' => $valnif,
                'nombre' => $valnombre,
                'apellido1' => $valape1,
                'apellido2' => $valape2,
                'email' => $valemail,
                'telefono' => $valtele,
                'direccion' => $valdire,
                'password' => $valpass
            ],
            "mensajes" => $this->mensajes,
            "login" => $login
        ];
        //Mostramos la vista actuser
        $this->view->show("EditarPerfil", $parametros);
    }

    //------------------------------------------------------------------------------
    //---------------------------------- ACTIVIDADES -------------------------------
    //------------------------------------------------------------------------------

        
    /**
     * Lista todas las actividades que tenemos en la BD
     *
     * @return void
     */
    public function listarActividades()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => []
        ];
        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarActiv();
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("ListarActividades", $parametros);
    }


        
    /**
     * Lista todas las actividades que tenemos por parte del ADMINISTRADOR
     *
     * @return void
     */
    public function listarActividadesAdmin()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => []
        ];
        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarActiv();
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("ListarActividadesAdmin", $parametros);
    }

        
    /**
     * Agregar una nueva actividad a la BD
     *
     * @return void
     */
    public function agregarActividad()
    {
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista

        // Si se ha pulsado el botón guardar...
        if (isset($_POST) && !empty($_POST) && isset($_POST['submit'])) { // y hemos recibido las variables del formulario y éstas no están vacías...
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
            $aforo = $_POST['aforo'];

            if (!preg_match("/[a-zA-Z0-9_-]{1,50}/", $nombre)) {
                $this->mensajes[] = [
                    "campo" => "nombre",
                    "tipo" => "danger",
                    "mensaje" => "Caracter no valido.  "
                ];
                $errores["nombre"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/[a-zA-Z0-9_-]{1,300}/", $descripcion)) {
                $this->mensajes[] = [
                    "campo" => "descripcion",
                    "tipo" => "danger",
                    "mensaje" => "Caracter no valido. "
                ];
                $errores["descripcion"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }

            if (!preg_match("/[0-9]{1,4}/", $aforo)) {
                $this->mensajes[] = [
                    "campo" => "aforo",
                    "tipo" => "danger",
                    "mensaje" => "Caracter no valido. "
                ];
                $errores["aforo"] = "Error: No valido";
                $parametros = ["mensajes" => $this->mensajes];
            }


            //Hay errores
            if (count($errores) > 0) {
                $this->view->show("ListarActividadesAdmin", $parametros);
            }

            // Si no se han producido errores realizamos el registro del usuario
            if (count($errores) == 0) {
                $resultModelo = $this->modelo->agregarActiv([
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'aforo' => $aforo
                ]);
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
            }
        }

        $this->listarActividadesAdmin();
    }

        
    /**
     * Método para editar una actividad en concreto
     *
     * @return void
     */
    public function editarActiv()
    {
        /**
         * Método de la clase controlador que permite actualizar los datos del usuario
         * cuyo id coincide con el que se pasa como parámetro desde la vista de listado
         * a través de GET
         */
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();
        // Inicializamos valores de los campos de texto
        $valnombre = "";
        $valdesc = "";
        $valaforo = "";
        $id = $_GET['id'];

        // Si se ha pulsado el botón actualizar...
        if (isset($_POST['submit'])) { //Realizamos la actualización con los datos existentes en los campos
            //$id = $_POST['id']; //Lo recibimos por el campo oculto
            $nuevonombre = $_POST['nombre'];
            $nuevadescripcion  = $_POST['descripcion'];
            $nuevoaforo = $_POST['aforo'];


            if (count($errores) == 0) {
                //Ejecutamos la instrucción de actualización a la que le pasamos los valores
                $resultModelo = $this->modelo->editarActividad([
                    'id' => $id,
                    'nombre' => $nuevonombre,
                    'descripcion' => $nuevadescripcion,
                    'aforo' => $nuevoaforo
                ]);
                //Analizamos cómo finalizó la operación de registro y generamos un mensaje
                //indicativo del estado correspondiente
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "El usuario se actualizó correctamente!! :)"
                    ];
                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "El usuario no pudo actualizarse!! :( <br/>({$resultModelo["error"]})"
                    ];
                endif;
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
            }

            // Obtenemos los valores para mostrarlos en los campos del formulario
            $valnombre = $nuevonombre;
            $valdesc  = $nuevadescripcion;
            $valaforo = $nuevoaforo;
        } else { //Estamos rellenando los campos con los valores recibidos del listado
            if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
                $id = $_GET['id'];
                //Ejecutamos la consulta para obtener los datos del usuario #id
                $resultModelo = $this->modelo->listaAct($id);
                //Analizamos si la consulta se realiz´correctamente o no y generamos un
                //mensaje indicativo
                if ($resultModelo["correcto"]) :
                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "Los datos del usuario se obtuvieron correctamente!! :)"
                    ];
                    $id = $resultModelo["datos"]["id"];
                    $valnombre = $resultModelo["datos"]["nombre"];
                    $valdesc  = $resultModelo["datos"]["descripcion"];
                    $valaforo = $resultModelo["datos"]["aforo"];
                else :
                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "No se pudieron obtener los datos de activiadades!! :( <br/>({$resultModelo["error"]})"
                    ];
                endif;
            }
        }
        //Preparamos un array con todos los valores que tendremos que rellenar en
        //la vista adduser: título de la página y campos del formulario
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => [
                "id" => $id,
                "nombre" => $valnombre,
                "descripcion"  => $valdesc,
                "aforo"    => $valaforo
            ],
            "mensajes" => $this->mensajes,
            "id" => $id
        ];
        //Mostramos la vista actuser
        $this->view->show("EditarActividad", $parametros);
    }

        
    /**
     * Método de la clase controlador que realiza la eliminación de una actividad a 
     * través del campo id
     *
     * @return void
     */
    public function delActividad()
    {
        // verificamos que hemos recibido los parámetros desde la vista de listado 
        if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
            $id = $_GET["id"];
            //Realizamos la operación de suprimir el usuario con el id=$id
            $resultModelo = $this->modelo->delActiv($id);
            //Analizamos el valor devuelto por el modelo para definir el mensaje a 
            //mostrar en la vista listado
            if ($resultModelo["correcto"]) :
                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Se eliminó correctamente la actividad $id"
                ];
            else :
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "La eliminación de la actividad no se realizó correctamente!! :( <br/>({$resultModelo["error"]})"
                ];
            endif;
        } else { //Si no recibimos el valor del parámetro $id generamos el mensaje indicativo:
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "No se pudo acceder al id de la actividad a eliminar!! :("
            ];
        }
        //Realizamos el listado de los usuarios
        $this->listarActividadesAdmin();
    }

    //------------------------------------------------------------------------------
    //---------------------------------- HORARIO -----------------------------------
    //------------------------------------------------------------------------------
    
    /**
     * Muestra el horario del gimnasio por parte del Adminitrador
     *
     * @return void
     */
    public function listarHorarioAdmin()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => []
        ];
        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarHorario();
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("HorarioAdmin", $parametros);
    }

    
    /**
     * Muestra el horario del gimnasio por parte de los usuarios
     *
     * @return void
     */
    public function horario()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => []
        ];
        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarHorario();
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
        //Definimos el mensaje para el alert de la vista de que todo fue correctamente

        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error        
        $this->view->show("Horario", $parametros);
    }

    
    /**
     * Función que agrega una actividad al horario por parte del administrador.
     * Carga la vista para agregar esa actividad al horario
     *
     * @return void
     */
    public function agregaActiv()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => [],
            "hora" => NULL,
            "dia" => NULL
        ];
        $dia = $_GET['dia'];
        $hora = $_GET['hora'];
        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarActiv();
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            $parametros["dia"] = $dia;
            $parametros["hora"] = $hora;
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("ActivHorario", $parametros);
    }

    
    /**
     * Vista cargada para agregar una actividad al horario y vuelve a cargar el horario
     *
     * @return void
     */
    public function guardarActivHorario()
    {
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();
        $actividad_id = NULL;
        $dia = NULL;
        $hora_inicio = NULL;
        $fecha_alta = NULL;
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista

        // Si se ha pulsado el botón guardar...
        if (isset($_POST) && !empty($_POST) && isset($_POST['submit'])) { // y hemos recibido las variables del formulario y éstas no están vacías...
            $actividad_id = $_POST['nombre'];
            $dia = $_POST["dia"];
            $hora_inicio = $_POST['hora'];
            $fecha_alta = $_POST['fecha_alta'];

            // Si no se han producido errores realizamos el registro del usuario
            if (count($errores) == 0) {
                $resultModelo = $this->modelo->agregaActivHorario([
                    'dia' => $dia,
                    'hora_inicio' => $hora_inicio,
                    'actividad_id' => $actividad_id,
                    'fecha_alta' => $fecha_alta
                ]);
                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "El listado se realizó correctamente"
                ];
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
            }
        }

        $this->listarHorarioAdmin();
    }

    
    /**
     * Funcion que borra del horario una actividad y recarga el horario.
     *
     * @return void
     */
    public function delHorarioActividad()
    {
        // verificamos que hemos recibido los parámetros desde la vista de listado 
        if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
            $id = $_GET["id"];
            //Realizamos la operación de suprimir el usuario con el id=$id
            $resultModelo = $this->modelo->delHorarioActiv($id);
            //Analizamos el valor devuelto por el modelo para definir el mensaje a 
            //mostrar en la vista listado
            if ($resultModelo["correcto"]) :
                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Se eliminó correctamente la actividad $id"
                ];
            else :
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "La eliminación de la actividad no se realizó correctamente!! :( <br/>({$resultModelo["error"]})"
                ];
            endif;
        } else { //Si no recibimos el valor del parámetro $id generamos el mensaje indicativo:
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "No se pudo acceder al id de la actividad a eliminar!! :("
            ];
        }
        //Realizamos el listado de los usuarios
        $this->listarHorarioAdmin();
    }

    
    /**
     * Carga la vista del administrador de todas las clases con los socios apuntados
     *
     * @return void
     */
    public function MostrarClasesAdmin()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "cargas" => NULL,
            "mensajes" => []
        ];

        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarHorario();
        $resultModelo2 = $this->modelo->listarClasesPrimera();

        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            $parametros["cargas"] = $resultModelo2["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;

        $this->view->show("MostrarClasesAdmin", $parametros);
    }

    
    /**
     * Carga la tabla de las clases de los socios apuntados
     *
     * @return void
     */
    public function CargarClasesAdmin()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "cargas" => NULL,
            "mensajes" => [],
            "id" => NULL
        ];

        $id = $_POST['nombre'];

        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo2 = $this->modelo->listarClasesUsuarios($id);
        $resultModelo = $this->modelo->listarHorario();
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            $parametros["cargas"] = $resultModelo2["datos"];
            $parametros["id"] = $id;
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("MostrarClasesAdmin", $parametros);
    }

    
    /**
     * Muestra todas las clases en que el usario pasado por la URL se haya apuntado
     *
     * @return void
     */
    public function mostrarClasesUser()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Mostrar clases del usuario",
            "datos" => NULL,
            "mensajes" => []
        ];

        $id = $_GET['id'];

        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo

        $resultModelo = $this->modelo->listadoClasesUsuario($id);

        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;

        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("MostrarClasesUser", $parametros);
    }

    
    /**
     * Método que sirve para inscribir a un usuario
     *
     * @return void
     */
    public function inscribirseActiv()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "datos" => [],
            "mensajes" => []
        ];
        //Cogemos el id del usuario a cambiar y el nuevo rol        

        $activ = $_GET['activ'];    //id
        $user = $_GET['user'];      //id
        $dia = $_GET['dia'];
        $inicio = $_GET['inicio'];
        $fecha_alta = date("Y-m-d");

        $resulBusqueda = $this->modelo->estaApuntadoClase($activ, $user);

        if ($resulBusqueda["correcto"]) :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado

            $resultModelo = $this->modelo->apuntarUsuarioClase([
                'dia' => $dia,
                'activ' => $activ,
                'user' => $user,
                'inicio' => $inicio,
                'fecha_alta' => $fecha_alta
            ]);
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "Te has registado a esa actividad correctamente :)"
            ];


        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "Ya te has registado a esa actividad :("
            ];
        endif;

        //Recargamos la página
        $this->horario();
    }


    //------------------------------------------------------------------------------
    //---------------------------------- Mensaje -----------------------------------
    //------------------------------------------------------------------------------

    
    /**
     * Carga los mensajes para poder escribir 1 nuevo y leer los mensajes que tengas
     *
     * @return void
     */
    public function cargarMensaje()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => [],
        ];

        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listado();

        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("MensajeAdmin", $parametros);
    }

    
    /**
     * Carga los mensajes para poder escribir 1 nuevo y leer los mensajes que tengas
     *
     * @return void
     */
    public function cargarMensajeUser()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => [],
        ];

        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listado();

        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("Mensaje", $parametros);
    }

    
    /**
     * Agrega un mensaje a la BD por parte del ADMINISTADOR
     *
     * @return void
     */
    public function AgregarMensajeAdmin()
    {
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();
        $usu_destino = NULL;
        $usu_origen = NULL;
        $mensaje = NULL;

        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista

        // Si se ha pulsado el botón guardar...
        if (isset($_POST) && !empty($_POST) && isset($_POST['submit'])) { // y hemos recibido las variables del formulario y éstas no están vacías...
            $usu_destino = $_POST['usu_destino'];
            $usu_origen = $_POST['usu_origen'];
            $mensaje = $_POST['mensaje'];

            // Si no se han producido errores realizamos el registro del usuario
            if (count($errores) == 0) {
                $resultModelo = $this->modelo->agregaMensaje([
                    'usu_destino' => $usu_destino,
                    'usu_origen' => $usu_origen,
                    'mensaje' => $mensaje
                ]);
                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "El listado se realizó correctamente"
                ];
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
            }
        }

        $this->cargarMensaje();
    }

    
    /**
     * Agrega un mensaje a la BD por parte de un usuario
     *
     * @return void
     */
    public function AgregarMensajeUser()
    {
        // Array asociativo que almacenará los mensajes de error que se generen por cada campo
        $errores = array();
        $usu_destino = NULL;
        $usu_origen = NULL;
        $mensaje = NULL;

        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista

        // Si se ha pulsado el botón guardar...
        if (isset($_POST) && !empty($_POST) && isset($_POST['submit'])) { // y hemos recibido las variables del formulario y éstas no están vacías...
            $usu_destino = $_POST['usu_destino'];
            $usu_origen = $_POST['usu_origen'];
            $mensaje = $_POST['mensaje'];

            // Si no se han producido errores realizamos el registro del usuario
            if (count($errores) == 0) {
                $resultModelo = $this->modelo->agregaMensaje([
                    'usu_destino' => $usu_destino,
                    'usu_origen' => $usu_origen,
                    'mensaje' => $mensaje
                ]);
                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "El listado se realizó correctamente"
                ];
            } else {
                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos!! :("
                ];
            }
        }

        $this->cargarMensajeUser();
    }

    
    /**
     * Lista los mensajes recibidos por el admin
     *
     * @return void
     */
    public function VerMensaje()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => [],
        ];

        $usu_destino = $_SESSION['id'];

        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarMensajes($usu_destino);
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("VerMensajeAdmin", $parametros);
    }

    
    /**
     * Lista los mensajes recibidos al usuario
     *
     * @return void
     */
    public function VerMensajeUser()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => [],
        ];

        $usu_destino = $_SESSION['id'];

        // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
        $resultModelo = $this->modelo->listarMensajes($usu_destino);
        // Si la consulta se realizó correctamente transferimos los datos obtenidos
        // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
        // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
        if ($resultModelo["correcto"]) :
            $parametros["datos"] = $resultModelo["datos"];
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
                "tipo" => "success",
                "mensaje" => "El listado se realizó correctamente"
            ];
        else :
            //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
        endif;
        //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
        //'mensaje', que recoge cómo finalizó la operación:
        $parametros["mensajes"] = $this->mensajes;
        // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
        $this->view->show("VerMensajeUser", $parametros);
    }
}
