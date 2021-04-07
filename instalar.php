<?php

include_once "config.php";
include_once "entidades/usuario.php";

$usuario = new Usuario();
$usuario->usuario = "pabloturnes";
$usuario->clave = $usuario->encriptarClave("turnes123");
$usuario->nombre = "Pablo Andres";
$usuario->apellido = "Turnes";
$usuario->correo = "pabloaTurnes@gmail.com";
$usuario->insertar();

?>