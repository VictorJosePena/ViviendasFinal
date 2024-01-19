<?php include_once "template/header.php" ;?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <a class="btn btn-secondary" href="form_insertar1.php">Ir al Formulario</a>
            <hr>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <h2>Listado </h2>
            <hr>


<?php 

header("Content-Type: text/html;charset=utf-8");
include_once "FuncionesConex/funcionesConexion.php" ;


$conexion=conectar();
if($conexion){
    //mysqli_set_charset($conexion,'utf8');
    $conexion->set_charset("utf8mb4");
    try {
        print("<form action='modYBorrar.php' method='post' autocomplete='off'>");
        
        $query= "SELECT id Identificador,tipo,zona,direccion as dirección,ndomitorios as 'Num Dormitorios',precio,tamano as tamaño,extras,foto,observaciones FROM viviendas";
        $resul=$conexion->query($query);
        consultaConTabla($resul);


        $resul->free();
        
    } catch (mysqli_sql_exception $e) {
        $resultado =true;
        $mensaje="hay algun problema al ejecutar la sentencia de lectura a la tabla de BD <br>" . $e->getMessage() . $conexion->connect_error . $conexion->connect_errno;
        $conexion->connect_error;
    }

    desconectar($conexion);

}else{
    $resultado =true;
    $mensaje="hay algun problema al conectar al BD <br>";
    $conexion->connect_error;
}

?>


<?php 
    if(isset($resultado)){

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?= $mensaje ?>
            </div>
        </div>
    </div>
</div>
<?php 
    }
?>

    </div>
    </div>
</div>





<?php include_once "template/footer.php" ?>