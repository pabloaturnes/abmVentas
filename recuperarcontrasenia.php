<?php
include_once "config.php";
include_once "entidades/usuario.php";

$usuario = new Usuario;



if($_POST){

    if(isset($_POST["txtNombreUsuario"])){   // si se carga txtusuario con algo
        $usuario->obtenerPorUsuario(trim($_POST["txtNombreUsuario"]));
        if(isset($usuario->nombre)){
            $_SESSION["usuario"] = $usuario->usuario;
            $_SESSION["pregunta"] = $usuario->pregunta;
            $_SESSION["respuesta"] = $usuario->respuesta;
            $_SESSION["idusuario"] = $usuario->idusuario;
        } else {
            $msj="el usuario ingresado no existe";
            $value="alert-danger";
            $_SESSION = array ();           // limpia la session
        }
    }

    if(isset($_POST["txtRespuesta"])){
        if($_POST["txtRespuesta"] == $_SESSION["respuesta"]) { // si se carga txtrespuesta con algo y no es igual a la respuesta del usuario
            $_SESSION["controlador"] = "si"; // variable residual de control usada para hacer aparecer y desaparecer los imputs del formulario.
        }else {
            $_SESSION = array ();           // limpia la session
            $msj="La respuesta ingresada es incorrecta";
            $value="alert-danger";
        }
    }   
     
    
    if(isset($_POST["txtContrasenia"])){
        $nuevaContrasenia = $usuario->encriptarClave(trim($_POST["txtContrasenia"]));
        $usuario->actualizarContraseña($_SESSION["idusuario"], $nuevaContrasenia);
        $_SESSION = array ();           // limpia la session
        $msj="La clave se ha restablecido correctamente!";
        $value="alert-success";
    }
        
    
}



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Pablo Turnes">

    <title>Recuperar Contraseña</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">¿Olvidaste tu contraseña?</h1>
                                        <p class="mb-4">!No te preocupes, esas cosas pasan! Introduce tu nombre de usuario y responde a tu pregunta secreta para recuperar tu contraseña. </p>
                                    </div>
                                    <form class="user" method="POST">
                                        <?php if(empty($_SESSION)) { ?>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="txtNombreUsuario" name="txtNombreUsuario" placeholder="Ingresa tu nombre de usuario...">
                                            </div>
                                        <?php } ?>
                                              
                                        <?php if(isset($_SESSION["usuario"]) && !isset($_SESSION["controlador"])){  ?>
                                            <b><p class="mb-4"> Bienvenido <?php echo $_SESSION["usuario"] ?>, tu pregunta secreta es: "<?php echo $_SESSION["pregunta"] ?>". </p></b>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="txtRespuesta" name="txtRespuesta" placeholder="Ingresa la respuesta...">
                                            </div>
                                        <?php } ?>

                                        <?php if(isset($_SESSION["controlador"])){  ?>
                                            <b><p class="mb-4"> Correcto! ingresa tu nueva contraseña. </p></b>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="txtContrasenia" name="txtContrasenia" placeholder="Ingresa la contraseña...">
                                            </div>
                                        <?php } ?>

                                        

                                        <?php if(isset($msj)){ ?>
                                            <div class="mt-3 alert <?php echo $value; ?> alert-dismissible fade show" role="alert">
                                                <strong><?php echo $msj; ?></strong> 
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php } ?>

                                        <button action="" type="submit" class="btn btn-primary btn-user btn-block">
                                            <?php if(empty($_SESSION)){ echo "Obtener Pregunta Secreta"; } ?>
                                            <?php if(isset($_SESSION["usuario"]) && !isset($_SESSION["controlador"])){ echo "Ingresar";  }?>
                                            <?php if(isset($_SESSION["controlador"])){ echo "Ingresar nueva contraseña";  }?>
                                            
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="registro.php">Crear una cuenta!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">¿Ya tenés una cuenta? Logueate!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>