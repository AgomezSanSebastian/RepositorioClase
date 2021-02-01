<?php
session_start();

/**
 *   Clase 'UserModel' que implementa el modelo de usuarios de nuestra aplicación en una
 * arquitectura MVC. Se encarga de gestionar el acceso a la tabla usuarios
 */
class UserModel extends BaseModel
{

   private $id;

   private $nif;

   private $nombre;

   private $apellido1;

   private $apellido2;

   private $email;

   private $login;

   private $password;

   private $telefono;

   private $direccion;

   private $imagen;

   private $rol;

   public function __construct()
   {
      // Se conecta a la BD
      parent::__construct();
      $this->table = "usuario";
   }

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNif()
   {
      return $this->nif;
   }

   public function setNif($nif)
   {
      $this->nif = $nif;
   }

   public function getNombre()
   {
      return $this->nombre;
   }

   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   public function getApellido1()
   {
      return $this->apellido1;
   }

   public function setApellido1($apellido1)
   {
      $this->apellido1 = $apellido1;
   }

   public function getApellido2()
   {
      return $this->apellido2;
   }

   public function setApellido2($apellido2)
   {
      $this->apellido2 = $apellido2;
   }

   public function getEmail()
   {
      return $this->email;
   }

   public function setEmail($email)
   {
      $this->email = $email;
   }

   public function getLogin()
   {
      return $this->login;
   }

   public function setLogin($login)
   {
      $this->login = $login;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function setPassword($password)
   {
      $this->password = $password;
   }

   public function getTelefono()
   {
      return $this->telefono;
   }

   public function setTelefono($telefono)
   {
      $this->telefono = $telefono;
   }

   public function getDireccion()
   {
      return $this->direccion;
   }

   public function setDireccion($direccion)
   {
      $this->direccion = $direccion;
   }

   public function getImagen()
   {
      return $this->imagen;
   }

   public function setImagen($imagen)
   {
      $this->imagen = $imagen;
   }

   public function getRol()
   {
      return $this->rol;
   }

   public function setRol($rol)
   {
      $this->rol = $rol;
   }

   //------------------------------------------------------------------------------
   //---------------------------------- USUARIOS ----------------------------------
   //------------------------------------------------------------------------------

   /**
    * Función que realiza el listado de todos los usuarios registrados
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    * @return type
    */
   public function listado()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM usuario";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Método que elimina el usuario cuyo id es el que se le pasa como parámetro 
    * @param $id es un valor numérico. Es el campo clave de la tabla
    * @return boolean
    */
   public function deluser($id)
   {
      // La función devuelve un array con dos valores:'correcto', que indica si la
      // operación se realizó correctamente, y 'mensaje', campo a través del cual le
      // mandamos a la vista el mensaje indicativo del resultado de la operación
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      //Si hemos recibido el id y es un número realizamos el borrado...
      if ($id && is_numeric($id)) {
         try {
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM usuario WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos si la eliminación se realizó correctamente... 
            if ($query) {
               $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
         }
      } else {
         $return["correcto"] = FALSE;
      }

      return $return;
   }

   /**
    * Añadir un nuevo usuario a la lista
    * @param type $datos
    * @return type
    */
   public function adduser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO `usuario`( `nif`, `nombre`, `apellido1`, `apellido2`, `imagen`, `login`, `password`, `email`, `telefono`, `direccion`, `rol`) 
                VALUES (:nif,:nombre,:apellido1,:apellido2,:imagen,:login,:password,:email,:telefono,:direccion,:rol)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'nif' => $datos["nif"],
            'nombre' => $datos["nombre"],
            'apellido1' => $datos["apellido1"],
            'apellido2' => $datos["apellido2"],
            'imagen' => $datos["imagen"],
            'login' => $datos["login"],
            'password' => $datos["password"],
            'email' => $datos["email"],
            'telefono' => $datos["telefono"],
            'direccion' => $datos["direccion"],
            'rol' => $datos["rol"]
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   /**
    * Método que actualiza un usuario
    * @param type $datos
    * @return type
    */
   public function actuser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "UPDATE `usuario` SET `nif`= :nif,`nombre`= :nombre,`apellido1`= :apellido1,`apellido2`= :apellido2,`password`= :password,`email`= :email,`telefono`= :telefono,`direccion`= :direccion WHERE id=:id";
         $query = $this->db->prepare($sql);
         $query->execute([
            'id' => $datos['id'],
            'nif' => $datos["nif"],
            'nombre' => $datos["nombre"],
            'apellido1' => $datos["apellido1"],
            'apellido2' => $datos["apellido2"],
            'password' => $datos["password"],
            'email' => $datos["email"],
            'telefono' => $datos["telefono"],
            'direccion' => $datos["direccion"]
         ]);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   
   /**
    * Lista el usuario con el id específico
    *
    * @param  mixed $id
    * @return void
    */
   public function listaUsuario($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      if ($id && is_numeric($id)) {
         try {
            $sql = "SELECT * FROM usuario WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
      }

      return $return;
   }

   
   /**
    * Muestra todos los datos de un usuario pasado por parámetro 
    *
    * @param  mixed $login
    * @return void
    */
   public function buscarPerfil($login)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      if ($login) {
         try {
            $sql = "SELECT * FROM usuario WHERE login=:login";
            $query = $this->db->prepare($sql);
            $query->execute(['login' => $login]);
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
      }

      return $return;
   }

   /**
    * Cambia el rol del usuario, pasa a de usuario normal a administrador o al revés
    * @param type $datos 
    * @return type
    */
   public function cambiarRolUser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "UPDATE usuario SET rol=:rol WHERE id=:id";
         $query = $this->db->prepare($sql);
         $query->execute([
            'id' => $datos["id"],
            'rol' => $datos["rol"]
         ]);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   
   /**
    * Lista de usurios nuevos que aún no han sido activados
    *
    * @return void
    */
   public function faltaPorActivar()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM usuario WHERE rol = '2'";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Comprobar si el usuario son de la base de datos. Para ello obtiene como parámetros 2 valores, 
    * el login y el password. 
    * @param type $datos 
    * @return array con 1 bool y mensaje de error si lo hubiera
    */
   public function isUser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         $sql = "SELECT * FROM usuario WHERE login =:login and password =:password";
         $query = $this->db->prepare($sql);
         $query->execute(['login' => $datos["login"], 'password' => $datos["password"]]);

         if ($query) {
            $usuarioDatos = $query->fetchAll();

            if (count($usuarioDatos) > 0) {
               $return["correcto"] = TRUE;
               $return["datos"] = $usuarioDatos;
            }
         }
      } catch (\Throwable $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   
   /**
    * Función que comprueba si el usuario está activado o no
    *
    * @param  mixed $login
    * @return void
    */
   public function userActivado($login)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      try {
         $sql = "SELECT id, rol FROM usuario WHERE login= :login";
         $query = $this->db->prepare($sql);
         $query->execute(['login' => $login]);
         //Supervisamos que la consulta se realizó correctamente... 
         if ($query) {
            $return["correcto"] = true;
            $return["datos"] = $query->fetch();
         }
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   //------------------------------------------------------------------------------
   //---------------------------------- ACTIVIDADES -------------------------------
   //------------------------------------------------------------------------------

   
   /**
    * Funcion que devuelve un array con todas las actividades que tenemos
    *
    * @return void
    */
   public function listarActiv()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM actividades";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   
   /**
    * Función que agrega a la BD una actividad
    *
    * @param  mixed $datos
    * @return void
    */
   public function agregarActiv($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO `actividades`( `nombre`, `descripcion`, `aforo`) 
                VALUES (:nombre,:descripcion,:aforo)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'nombre' => $datos["nombre"],
            'descripcion' => $datos["descripcion"],
            'aforo' => $datos["aforo"]
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }
   }

   
   /**
    * Función que modifica una actividad de la BD
    *
    * @param  mixed $datos
    * @return void
    */
   public function editarActividad($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "UPDATE `actividades` SET `nombre`=:nombre,`descripcion`=:descripcion,`aforo`=:aforo WHERE id=:id";
         $query = $this->db->prepare($sql);
         $query->execute([
            'id' => $datos["id"],
            'nombre' => $datos["nombre"],
            'descripcion' => $datos["descripcion"],
            'aforo' => $datos["aforo"]
         ]);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   
   /**
    * Función que devuelve una actividad que coincida con el parámetro que se le haya enviado
    *
    * @param  mixed $id
    * @return void
    */
   public function listaAct($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      if ($id && is_numeric($id)) {
         try {
            $sql = "SELECT * FROM actividades WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
      }

      return $return;
   }


   /**
    * Método que elimina la actividad cuyo id es el que se le pasa como parámetro 
    * @param $id es un valor numérico. Es el campo clave de la tabla
    * @return boolean
    */
   public function delActiv($id)
   {
      // La función devuelve un array con dos valores:'correcto', que indica si la
      // operación se realizó correctamente, y 'mensaje', campo a través del cual le
      // mandamos a la vista el mensaje indicativo del resultado de la operación
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      //Si hemos recibido el id y es un número realizamos el borrado...
      if ($id && is_numeric($id)) {
         try {
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM actividades WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos si la eliminación se realizó correctamente... 
            if ($query) {
               $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
         }
      } else {
         $return["correcto"] = FALSE;
      }

      return $return;
   }


   //------------------------------------------------------------------------------
   //---------------------------------- HORARIO -----------------------------------
   //------------------------------------------------------------------------------

   
   /**
    * Función que devuelve un array con todas las activides que tenemos en el horario
    *
    * @return void
    */
   public function listarHorario()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT `tramo_horario`.`id` AS id, `tramo_horario`.`dia` AS `dia`, `tramo_horario`.`hora_inicio` AS `inicio`, `actividades`.`nombre` AS `nombre`
         FROM `tramo_horario` 
            LEFT JOIN `actividades` ON `tramo_horario`.`actividad_id` = `actividades`.`id`;";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   
   /**
    * Funcion que agrega una actividad al horario
    *
    * @param  mixed $datos
    * @return void
    */
   public function agregaActivHorario($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO `tramo_horario`( `dia`, `hora_inicio`, `actividad_id`, `fecha_alta`)  
                VALUES (:dia,:hora_inicio,:actividad_id,:fecha_alta)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'dia' => $datos["dia"],
            'hora_inicio' => $datos["hora_inicio"],
            'actividad_id' => $datos["actividad_id"],
            'fecha_alta' => $datos["fecha_alta"]
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }
   }

   
   /**
    * Función que borra del horario una actividad
    *
    * @param  mixed $id
    * @return void
    */
   public function delHorarioActiv($id)
   {
      // La función devuelve un array con dos valores:'correcto', que indica si la
      // operación se realizó correctamente, y 'mensaje', campo a través del cual le
      // mandamos a la vista el mensaje indicativo del resultado de la operación
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      //Si hemos recibido el id y es un número realizamos el borrado...
      if ($id && is_numeric($id)) {
         try {
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM tramo_horario WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos si la eliminación se realizó correctamente... 
            if ($query) {
               $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
         }
      } else {
         $return["correcto"] = FALSE;
      }

      return $return;
   }

   
   /**
    * Lista la primera clase de la lista de ID 
    *
    * @return void
    */
   public function listarClasesPrimera()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL           
         $sql = "SELECT `usuario`.`login`, `usuario`.`nombre`, `usuario`.`apellido1`, `usuario`.`apellido2`, `usuario`.`telefono`
         FROM `usuario`
         WHERE `usuario`.`id` in (SELECT `tramo_usuario`.`usuario_id`
                  FROM `tramo_usuario`
                  WHERE `tramo_usuario`.`tramo_id` =(SELECT id FROM `tramo_horario` ORDER by ID ASC LIMIT 1));";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   
   /**
    * Lista los usuarios con el id pasado por parametros del tramo_Horario
    *
    * @param  mixed $id
    * @return void
    */
   public function listarClasesUsuarios($id)
   {
      $return = [
         "correcto" => false,
         "datos" => null,
         "error" => null
      ];

      if ($id && is_numeric($id)) {
         try {
            $sql = "SELECT `usuario`.`login`, `usuario`.`nombre`, `usuario`.`apellido1`, `usuario`.`apellido2`, `usuario`.`telefono` 
                  FROM `usuario` 
                  WHERE `usuario`.`id` IN 
                     (SELECT `tramo_usuario`.`usuario_id` FROM `tramo_usuario` WHERE `tramo_usuario`.`tramo_id` = :id)";

            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //$query->execute();

            //Supervisamos que la consulta se realizó correctamente...
            if ($query) {
               $return["correcto"] = true;
               $return["datos"] = $query->fetchAll(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
         //}

         return $return;
      }
   }
   
   /**
    * Comprueba si un usurio esta apuntado a una actividad
    *
    * @param  mixed $tramo_id
    * @param  mixed $usuario_id
    * @return void
    */
   public function estaApuntadoClase($tramo_id, $usuario_id)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         $sql = "SELECT * FROM tramo_usuario WHERE tramo_id =:tramo_id and usuario_id =:usuario_id";
         $query = $this->db->prepare($sql);
         $query->execute(['tramo_id' => $tramo_id, 'usuario_id' => $usuario_id]);

         if ($query) {
            $usuarioDatos = $query->fetchAll();

            if (count($usuarioDatos) == 0) {
               $return["correcto"] = TRUE;
               //$return["datos"] = $usuarioDatos;
            }
         }
      } catch (\Throwable $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   
   /**
    * Función donde un usuario puede apuntarte a una clase específica
    *
    * @param  mixed $datos
    * @return void
    */
   public function apuntarUsuarioClase($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO `tramo_usuario`(`tramo_id`, `usuario_id`, `fecha_actividad`, `hora_activ`, `fecha_reserva`)   
                VALUES (:tramo_id,:usuario_id,:fecha_actividad,:hora_activ,:fecha_alta)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'tramo_id' => $datos["activ"],
            'usuario_id' => $datos["user"],
            'fecha_actividad' => $datos["dia"],
            'hora_activ' => $datos["inicio"],
            'fecha_alta' => $datos["fecha_alta"]
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }
   }

   
   /**
    * Función donde lista todas las clases apuntadas por un usario específico pasado por parámetros
    *
    * @param  mixed $id
    * @return void
    */
   public function listadoClasesUsuario($id)
   {
      $return = [
         "correcto" => false,
         "datos" => null,
         "error" => null
      ];

      if ($id && is_numeric($id)) {
         try {
            $sql = "SELECT `actividades`.`nombre`, `tramo_usuario`.`fecha_actividad`, `tramo_usuario`.`hora_activ`, `tramo_usuario`.`fecha_reserva`
            FROM `actividades`
               , `tramo_usuario`, `tramo_horario`
            WHERE `actividades`.`id` = `tramo_horario`.`actividad_id` and `tramo_horario`.`id` = `tramo_usuario`.`tramo_id` AND `tramo_usuario`.`usuario_id`= :id";

            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);

            //Supervisamos que la consulta se realizó correctamente...
            if ($query) {
               $return["correcto"] = true;
               $return["datos"] = $query->fetchAll(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
         //}

         return $return;
      }
   }

   //------------------------------------------------------------------------------
   //---------------------------------- MENSAJE -----------------------------------
   //------------------------------------------------------------------------------

   
   /**
    * Agregamos un nuevo mensaje a la bd
    *
    * @param  mixed $datos
    * @return void
    */
   public function agregaMensaje($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO `mensajes`(`usu_origen`, `usu_destino`, `mensaje`) 
               VALUES (:usu_origen,:usu_destino,:mensaje)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'usu_origen' => $datos["usu_origen"],
            'usu_destino' => $datos["usu_destino"],
            'mensaje' => $datos["mensaje"]
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }
   }
   
   /**
    * Muestra todos los usuarios y  mensajes recibidos 
    *
    * @param  mixed $usu_destino
    * @return void
    */
   public function listarMensajes($usu_destino)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      if ($usu_destino && is_numeric($usu_destino)) {
         try {
            $sql = "SELECT usuario.login,mensajes.id,mensajes.usu_origen,mensajes.usu_destino,mensajes.mensaje
            FROM mensajes JOIN usuario ON mensajes.usu_origen = usuario.id
            WHERE mensajes.usu_destino = :usu_destino";
            $query = $this->db->prepare($sql);
            $query->execute(['usu_destino' => $usu_destino]);
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetchAll(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
      }

      return $return;
   }


   //------------------------------------------------------------------------------
   //---------------------------------- PAGINAR -----------------------------------
   //------------------------------------------------------------------------------

   
   /**
    * Función que consigo los datos necesarios para poder hacer una paginación por parte 
    * del administrador. Sobre la table usuarios activos de la base de datos.
    *
    * @param  mixed $regsxpag
    * @param  mixed $offset
    * @return void
    */
   public function paginarUsuarios($regsxpag, $offset)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT count(*) as total FROM usuario";
         // Hacemos directamente la consulta al no tener parámetros
         $totalregistros = $this->db->query($sql);
         $totalregistros = $totalregistros->fetch()['total'];

         //Sintaxis más clara
         $sql = "SELECT * FROM usuario  ORDER BY nombre LIMIT $regsxpag OFFSET $offset";

         $registros = $this->db->prepare($sql);
         $registros->execute();

         //Supervisamos si la inserción se realizó correctamente... 
         if ($registros) :
            $return["correcto"] = TRUE;
            $return["datos"] = $registros->fetchAll(PDO::FETCH_ASSOC);
            $return["totalregistros"] = $totalregistros;
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   
   /**
    * Función que busca alguna coincidencia con el parámetro @palabra. A parte 
    * también hace la paginación.
    *
    * @param  mixed $regsxpag
    * @param  mixed $offset
    * @param  mixed $palabra
    * @return void
    */
   public function paginarUsuariosBuscar($regsxpag, $offset,$palabra)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT count(*) as total 
               FROM usuario 
               WHERE nombre 
                  LIKE '%$palabra%' OR apellido1 LIKE '%$palabra%' OR apellido2 LIKE '%$palabra%' 
                  OR login LIKE '%$palabra%' OR email LIKE '%$palabra%' OR direccion LIKE '%$palabra%'";
         // Hacemos directamente la consulta al no tener parámetros
         $totalregistros = $this->db->query($sql);
         $totalregistros = $totalregistros->fetch()['total'];

         //Sintaxis más clara
         $sql = "SELECT * FROM usuario 
               WHERE nombre LIKE '%$palabra%' OR apellido1 LIKE '%$palabra%' OR apellido2 LIKE '%$palabra%' OR nif LIKE '%$palabra%'
                  OR login LIKE '%$palabra%' OR email LIKE '%$palabra%' OR direccion LIKE '%$palabra%' OR telefono LIKE '%$palabra%'
                  ORDER BY nombre LIMIT $regsxpag OFFSET $offset";

         $registros = $this->db->prepare($sql);
         $registros->execute();

         //Supervisamos si la inserción se realizó correctamente... 
         if ($registros) :
            $return["correcto"] = TRUE;
            $return["datos"] = $registros->fetchAll(PDO::FETCH_ASSOC);
            $return["totalregistros"] = $totalregistros;
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }
}
