<?php

include_once "config.php";
include_once "entidades/tipoproducto.php";
$pg = "Edición de tipo de productos";
$msj= "";
$value="";

$tipoproducto = new Tipoproducto();
$tipoproducto->cargarFormulario($_REQUEST);

if($_POST){
    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
              //Actualizo un cliente existente
              $tipoproducto->actualizar();
              $msj= "El tipo de producto ha sido actualizado correctamente";
              $value="alert-success";
        } else {
            //Es nuevo
            $tipoproducto->insertar();
            $msj= "El tipo de producto ha sido guardado correctamente";
            $value="alert-primary";
        }
    } else if(isset($_POST["btnBorrar"])){
        $tipoproducto->eliminar();
        $msj= "El tipo de producto ha sido borrado correctamente";
        $value="alert-danger";
    }
} 
if(isset($_GET["id"]) && $_GET["id"] > 0){
    $tipoproducto->obtenerPorId();
}

include_once("header.php"); 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Tipo de productos</h1>
           <div class="row">
                <div class="col-6 mb-3">
                    <a href="tipoproductos.php" class="btn btn-primary mr-2">Listado</a>
                    <a href="tipoproducto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                    <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                </div>
                <?php if($msj) {  ?>
                    <div class="col-6 mb-3">
                        <div class="alert <?php echo $value; ?> alert-dismissible fade show" role="alert">
                            <strong> <?php echo $msj; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required="" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $tipoproducto->nombre; ?>">
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once("footer.php"); ?>