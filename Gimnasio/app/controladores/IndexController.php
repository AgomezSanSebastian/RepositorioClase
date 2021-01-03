<?php
/**
 * Controlador de la página index desde la que se puede hacer el login y el registro
 */

 /**
 * Incluimos todos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

class IndexController extends BaseController
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
      $this->view->show("Inicio",$parametros);
   }

   /**
    * Podemos implementar la acción login
    *
    * @return void
    */
   public function login()
   {
      $parametros = [
         "tituloventana" => "Login a la aplicación"
      ];
      $this->view->show("Login",$parametros);
     
   }

   /**
    * Podemos implementar la acción registro de usuarios
    *
    * @return void
    */
   public function registro()
   {
      $parametros = [
         "tituloventana" => "Registro a la aplicación"
      ];
      $this->view->show("Registro",$parametros);
      
   }

   /**
    * Otras acciones que puedan ser necesarias
    */
}
