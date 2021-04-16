

<?php 
include_once "config.php";
include_once "entidades/usuario.php";

$msj= "";
$value="";

if(isset($_POST["crearcuenta"])){

  if($_POST["contrasenia"]== $_POST["repetircontrasenia"]){
    $usuario = new Usuario();
    $usuario->usuario = $_POST["usuario"];
    $usuario->clave = $usuario->encriptarClave($_POST["contrasenia"]);
    $usuario->nombre = $_POST["nombre"];
    $usuario->apellido = $_POST["apellido"];
    $usuario->correo = $_POST["email"];
    $usuario->insertar();
  }else{
    $msj="La contraseña ingresada no coincide con la contraseña repetida";
    $value="alert-danger";
  }
  

}



?>


<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registrate</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crea tu cuenta!</h1>
              </div>
              <form class="user" method="POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="nombre" id="nombre" placeholder="Nombre" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="apellido" id="apellido" placeholder="Apellido" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="usuario" id="usuario" placeholder="Usuario" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="direccion@gmail.com" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="contrasenia" id="contrasenia" placeholder="Contraseña" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="repetircontrasenia" id="repetircontrasenia" placeholder="Repetir contraseña" required>
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block" type="submit" name="crearcuenta" >  
                  Registrar Cuenta
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Olvide mi contraseña</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">¿Ya tenés una cuenta? Logueate! </a>
              </div>
              <?php if($msj) {  ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $msj; ?>
                </div>
              <?php } ?>
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
