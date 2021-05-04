<?php 

include_once "entidades/usuario.php";
include_once "config.php";

class Formulario{
   public function __construct($nombre = "", $apellido="", $usuario="", $contrasenia="", $contrasenia2="", $correo="", $pregunta="", $respuesta=""){

    // elimino espacios antes y despues de todos los caracteres ingresados
    $nombre = trim($nombre);
    $apellido= trim($apellido);
    $usuario= trim($usuario);
    $contrasenia = trim($contrasenia);
    $contrasenia2 = trim($contrasenia2);
    $correo= trim($correo);
    $pregunta = trim($pregunta);
    $respuesta = trim($respuesta);

    // cargo propiedades del objeto con parametros de la funcion constructora

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
        $this->contrasenia2= $contrasenia2;
        $this->correo = $correo;
        $this->pregunta = $pregunta;
        $this->respuesta = $respuesta;
        $this->mensaje = "";
        $this->formularioOk = "false";

        // hago validaciones

        if($this->validarCadena("nombre",$nombre,5) == false){return;};
        if($this->validarCadena("apellido",$apellido,5) == false){return;};
        if($this->validarContrasenia("contraseña",$contrasenia,$contrasenia2,5) == false){return;};
        if($this->validarPreguntaSecreta("pregunta secreta",$pregunta) == false){return;};
        if($this->validarPreguntaSecreta("Respuesta",$respuesta) == false){return;};
        // tenes que hacer la validacion del usuario, preguntando si ya hay otro usuario en la base de datos con el mismo nombre

        $this->mensaje = "El usuario se ha creado correctamente";
        $this->formularioOk = "true";
    }

    public function validarCadena($nombrePropiedad,$propiedad,$valor){
        $valorMin=$valor;
        $valorMax=$valor*3;
        $expresionRegular= "/[^a-zA-Z0-9]/"; //solo recibe letras y numeros

        if($propiedad==""){    // pregunta si la propiedad ingresada esta vacia
            $this->mensaje ="$nombrePropiedad ingresado esta vacío";
            return false;
        };

        if(!(is_string($propiedad))){  // pregunta si la propiedad ingresada no es una cadena
            $this->mensaje ="$nombrePropiedad ingresado no es de tipo cadena de texto";
            return false;
        };

        if(strlen($propiedad) < $valorMin){
            $this->mensaje ="$nombrePropiedad debe tener al menos $valorMin caracteres";
            return false;
        };
     
        if(strlen($propiedad) > $valorMax){
            $this->mensaje ="$nombrePropiedad debe tener un maximo de $valorMax caracteres";
            return false;
        }
        
        if(preg_match($expresionRegular,$propiedad)==1){
            $this->mensaje="$nombrePropiedad solo admite letras y numeros";
            return false;
        }
        return true;
    }

    public function validarContrasenia($nombrePropiedad,$contrasenia,$contrasenia2,$valor){  // valida la contraseña ingresada

        if($contrasenia!=$contrasenia2){        // consulta si las contraseñas ingresadas son iguales
            $this->mensaje="$nombrePropiedad no coincide con la ingresada";
            return false;
        }
        
        if($this->validarCadena($nombrePropiedad,$contrasenia,$valor) == false ){return false;}; // consulta si la contraseña1 cumple los parametros de cadena, si no los cumple retorna falso
        if($this->validarCadena($nombrePropiedad,$contrasenia2,$valor)== false ){return false;};// consulta si la contraseña2 cumple los parametros de cadena, si no los cumple retorna falso
        return true;
    }

    public function validarPreguntaSecreta($nombrePropiedad,$propiedad){
        if($propiedad==""){    // pregunta si la propiedad ingresada esta vacia
            $this->mensaje ="$nombrePropiedad ingresado esta vacío";
            return false;;
        };

        if(!(is_string($propiedad))){  // pregunta si la propiedad ingresada no es una cadena
            $this->mensaje ="$nombrePropiedad ingresado no es de tipo cadena de texto";
            return false;
        };
        
        return true;
    }


}



?>