<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0",false);
header("Pragma: no-cache");

?>

<?php include "template/header.php"; ?>

<?php 
header("Content-Type: text/html;charset=utf-8");
include_once "FuncionesConex/funciones.php" ;
include_once "FuncionesConex/funcionesConexion.php" ;
include_once "FuncionesConex/funcionesModYBorrar.php" ;
?>
<div class='container'>
    <div class='row'>
    <div class='col-md-12'>
    <hr>

<?php  if(isset($_POST['volver'])){

function redireccionar($url) {
    header("Location: $url");
    exit(); // Asegura que el script se detenga después de la redirección
}
    
// Uso de la función
$urlDestino = "leerTabla.php"; 
redireccionar($urlDestino);

    }else if(isset($_POST['eliminar'])){
        ?>

        
        <a class="btn btn-secondary" href="leerTabla.php">Visualizar Inmuebles</a>
        
            <?php
        $borrar=$_POST['eliminar'];


    $conexion=conectar();
    
    if($conexion){
        mysqli_set_charset($conexion,'utf8');
    
        
        
        $saberNomFoto = "SELECT * FROM viviendas where id = $borrar";
        $consultaFoto = mysqli_query($conexion,$saberNomFoto);
        $resultado = mysqli_fetch_array($consultaFoto,  MYSQLI_ASSOC);
        if($resultado['foto']=""){

            $nombreArc=$resultado['foto'];
            unlink("fotos_viviendas/{$nombreArc}");
        }

        

        $query ="DELETE FROM viviendas WHERE id = $borrar";
        $consulta = mysqli_query($conexion,$query);
        

        if(!$consulta){
            print("<hr><div class='alert alert-danger' role='alert'>Error al eliminar el registro</div>");
        
        }else{
            print("<hr><div class='alert alert-success' role='alert'>Eliminado Correctamente</div>");
        }

        desconectar($conexion);
    
    }
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