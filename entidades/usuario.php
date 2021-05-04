<?php

class Usuario {

  
    public function __construct(){       
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    public function setearUsuario($formulario){
        $this->idusuario = "";
        $this->nombre = $formulario->usuario;
        $this->apellido = $formulario->apellido;
        $this->usuario = $formulario->usuario;
        $this->contrasenia= $formulario->contrasenia;
        $this->correo=$formulario->correo;
        $this->pregunta=$formulario->pregunta;
        $this->respuesta = $formulario->respuesta;
    }

    public function cargarFormulario($request){
        $this->idusuario = isset($request["id"])? $request["id"] : "";
        $this->nombre = isset($request["nombre"])? $request["nombre"] : "";
        $this->apellido = isset($request["apellido"])? $request["apellido"]: "";
        $this->usuario = isset($request["usuario"])? $request["usuario"] : "";
        $this->contrasenia = isset($request["contrasenia"])? $request["contrasenia"] : "";
        $this->correo = isset($request["correo"])? $request["correo"]: "";
        $this->pregunta = isset($request["pregunta"])? $request["pregunta"]: "";
        $this->respuesta = isset($request["respuesta"])? $request["respuesta"]: "";
    }

    public function insertar(){
        // encripta la contraseña ingresada por el usuario y la asigna a la propiedad contraseña del objeto usuario
        $this->contrasenia = password_hash($this->contrasenia, PASSWORD_DEFAULT);

        //Instancia la clase mysqli con el constructor parametrizado
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        // consulta primero si existe un usuario  o un correo identico, si existe alguno escapa a la funcion insertar mediante el return
        $usuario=$mysqli->query("SELECT usuario FROM usuarios WHERE usuario='$this->usuario'");
        if(mysqli_num_rows($usuario)>0){
            return true;
        }

        $correo=$mysqli->query("SELECT correo FROM usuarios WHERE correo='$this->correo'");
        if(mysqli_num_rows($correo)>0){
            return true;
        }
        


        // si no existe un usuario ni correo repetidos arma la query para insertar el usuario
        $sql = "INSERT INTO usuarios (
                    nombre, 
                    apellido, 
                    usuario,
                    contrasenia, 
                    correo,
                    pregunta,
                    respuesta
                ) VALUES (
                    '" . $this->nombre ."',
                    '" . $this->apellido ."',
                    '" . $this->usuario ."', 
                    '" . $this->contrasenia ."', 
                    '" . $this->correo ."',
                    '" . $this->pregunta ."',
                    '" . $this->respuesta ."'
                );";
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por la inserción
        $this->idusuario = $mysqli->insert_id;
        //Cierra la conexión
        $mysqli->close();
    }

    public function actualizar(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE usuarios SET
                nombre = ".$this->nombre.",
                apellido = ".$this->apellido.",
                usuario = '".$this->usuario."',
                contrasenia = '".$this->contrasenia."',
                correo = ".$this->correo.",
                pregunta = ".$this->pregunta.",
                respuesta = ".$this->respuesta."
                WHERE idusuario = " . $this->idusuario;
          
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function actualizarContraseña($idusuario,$contrasenia){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE usuarios SET
                contrasenia = '".$contrasenia."'
                WHERE idusuario = " . $idusuario;
          
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }



    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM usuarios WHERE idusuario = " . $this->idusuario;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idusuario,
                        nombre,
                        apellido,  
                        usuario, 
                        contrasenia,
                        correo,
                        pregunta,
                        respuesta
                FROM usuarios 
                WHERE idusuario = " . $this->idusuario;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado en un array asociativo
        if($fila = $resultado->fetch_assoc()){
            $this->idusuario = $fila["idusuario"];
            $this->nombre = $fila["nombre"];
            $this->apellido = $fila["apellido"];
            $this->usuario = $fila["usuario"];
            $this->contrasenia = $fila["contrasenia"];
            $this->correo = $fila["correo"];
            $this->pregunta = $fila["pregunta"];
            $this->respuesta = $fila["respuesta"];
        }
        $mysqli->close();
    }

    public function obtenerPorUsuario($usuario){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idusuario,
                        nombre,
                        apellido, 
                        usuario, 
                        contrasenia,
                        correo,
                        pregunta,
                        respuesta
                FROM usuarios 
                WHERE usuario = '$usuario'";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado en un array asociativo
        if($fila = $resultado->fetch_assoc()){
            $this->idusuario = $fila["idusuario"];
            $this->nombre = $fila["nombre"];
            $this->apellido = $fila["apellido"];
            $this->usuario = $fila["usuario"];
            $this->contrasenia = $fila["contrasenia"];
            $this->correo = $fila["correo"];
            $this->pregunta = $fila["pregunta"];
            $this->respuesta = $fila["respuesta"];
        }
        $mysqli->close();
    }

    public function obtenerTodos(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idusuario, nombre, apellido, usuario, contrasenia, correo, pregunta, respuesta FROM usuarios";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if($resultado){
            //Convierte el resultado en un array asociativo
            while($fila = $resultado->fetch_assoc()){
                $entidadAux = new Usuario();
                $entidadAux->idusuario = $fila["idusuario"];
                $entidadAux->nombre = $fila["nombre"];
                $entidadAux->apellido = $fila["apellido"];
                $entidadAux->usuario = $fila["usuario"];
                $entidadAux->contrasenia = $fila["contrasenia"];
                $entidadAux->correo = $fila["correo"];
                $entidadAux->pregunta = $fila["pregunta"];
                $entidadAux->respuesta = $fila["respuesta"];
                $aResultado[] = $entidadAux;
            }
        }
        return $aResultado;
    }

    public function encriptarClave($clave){
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
        return $claveEncriptada;
    }

    public function verificarClave($claveIngresada, $claveEnBBDD){
        return password_verify($claveIngresada, $claveEnBBDD);
    }

}


?>