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
     * Funcion para cerrar sesion y volver al principio
     */
    public function cerrarSesion()
    {
        session_destroy();
        $this->view->show("Inicio");
    }

    /**
     * 
     */
    public function listarUser()
    {
        // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
        $parametros = [
            "tituloventana" => "Base de Datos con PHP y PDO",
            "datos" => NULL,
            "mensajes" => []
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
        $this->view->show("ListarUsuarios", $parametros);
    }

    public function listarNoActivos()
    {
        $this->view->show("ListarNoActivos");
    
    }
}
