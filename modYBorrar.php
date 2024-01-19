<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0",false);
header("Pragma: no-cache");

?>

<?php include "template/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <a class="btn btn-secondary" href="leerTabla.php">Visualizar Profesores</a>

            <hr>
        </div>
    </div>
</div>

<?php 
header("Content-Type: text/html;charset=utf-8");
include_once "FuncionesConex/funcionesConexion.php" ;
include_once "FuncionesConex/funcionesModYBorrar.php" ;
?>
<div class='container'>
    <div class='row'>
    <div class='col-md-12'>
    <hr>

<?php  if(isset($_POST['modificar'])){
    
    print("<h2 class='mt-3'>Editar profesor</h2>");
    modificarviviendas();


    }else if(isset($_POST['borrar'])){
     print("<h2 class='mt-3'>Vivienda a eliminar</h2>");
    eliminarVivienda();
    
    }
?>

</div>
</div>
</div>


<?php 


?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="" role="">
                <!--  mensaje  -->
            </div>
        </div>
    </div>
</div>


    </div>
    </div>
</div>





<?php include_once "template/footer.php" ?>