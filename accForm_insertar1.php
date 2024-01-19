<?php

header("Content-Type: text/html;charset=utf-8");
include_once "FuncionesConex/funciones.php" ;
include_once "FuncionesConex/funcionesConexion.php" ;
?>

<?php include_once "template/header.php" ;?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <a class="btn btn-secondary" href="leerTabla.php" >Visualizar Inmuebles </a>
            <a class="btn btn-secondary" href="form_insertar1.php" >Añadir mas Inmuebles </a>

            <hr>
        </div>
    </div>
</div>



<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //VARIABLES
    $errores=array();
   
    $tipo= filtrado($_POST["tipo"]);
    $zona= filtrado($_POST["zona"]);
    $direccion = filtrado($_POST["direccion"]);
    $ndormitorios = filtrado($_POST["ndormitorios"]);
    $precio = filtrado($_POST["precio"]);
    $tamano = filtrado($_POST["tamano"]);
    $observaciones = filtrado($_POST["observaciones"]);
   



    if(empty($tipo)){
        $errores[]="El tipo de vivienda no puede estar vacio"; 
    }
    if(empty($zona)){
        $errores[]="La zona no puede estar vacio"; 
    }
    /*|| preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/",$direccion) */
    if(empty($direccion) ){
        $errores[]="La direccion no puede estar vacio"; 
    }
    if(empty($ndormitorios)){
        $errores[]="El numero de dormitorios no puede estar vacio"; 
    }
    if(empty($precio) || $precio<10000){
        $errores[]="La precio no puede estar vacio o el precio es demasiado bajo"; 
    }
    if(empty($tamano)){
        $errores[]="El tamaño de vivienda no puede estar vacio"; 
    }
    if(empty($_POST["extras"])){
        $extras="";
    }else{
        $ex =$_POST["extras"];
        $extras=implode(",",$ex);
        
    }


$haysubida=false;
$nombreArchivo="";
    if(empty($errores)){
        $archivo=(isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
        

        if($_FILES['archivo']['name']){
            $extension=strtolower(pathinfo($archivo['name'],PATHINFO_EXTENSION));

            if($extension =="jpg" || $extension =="png" ){

                try{
                    $idfich=saberProximaId2();

                    try{

                        $nomarchivo=$idfich.$_FILES["archivo"]["name"];
                        $ruta_destino_archivo="fotos_viviendas/$nomarchivo";
                        $archivo_ok=move_uploaded_file($archivo['tmp_name'],$ruta_destino_archivo);

                        if(!$archivo_ok){
                            throw new Exception('ERROR: Al subir al archivo al servidor.<br>');
                        }else{
                            $haysubida=true;
                            $nombreArchivo=$nomarchivo;
                        }


                    }catch(Exception $e){
                        $errores[]="Error: ". $_FILES['archivo']['error'] ."--". $e->getMessage();
                    }
                }catch(Exception $e){
                    $errores[]="Error producido por la Excepcion: ". $e->getMessage();
                }
            }else{
                $errores="Solo se admiten jpg y png.";
            }

        }
    }



    


    if(empty($errores)){
        $conexion = conectar();
        if($conexion){
            mysqli_set_charset($conexion, 'utf8');
            try{
                $stmt = mysqli_prepare($conexion,"INSERT INTO viviendas(tipo,zona,direccion,ndomitorios,precio,tamano,extras,foto,observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                mysqli_stmt_bind_param($stmt, "ssssddsss", $varTipo, $varZona, $varDireccion, $varNDormitorios, $varPrecio, $varTamano, $varExtras,$varFoto,$varObservaciones);

                $varTipo = $tipo;
                $varZona = $zona;
                $varDireccion = $direccion;
                $varNDormitorios = $ndormitorios;
                $varPrecio = $precio;
                $varTamano = $tamano;
                $varExtras = $extras;
                $varFoto = $nombreArchivo;
                $varObservaciones = $observaciones;

                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);
                $resultado = true;
                $mensaje="VIVIENDA INSERTADA EN LA BASE DE DATOS";
            }
            catch(mysqli_sql_exception $e){
                $resultado = false;
                $mensaje="Ha habido una excepción: ". mysqli_connect_error() . mysqli_connect_errno();
                echo $mensaje;
                unlink("fotos_viviendas/{$nombreArchivo}");

            }
            desconectar($conexion);

        }
    }else{
        echo "<ul>";
            foreach($errores as $e){
                echo "<li> $e </li>";
            }
            echo "</ul>";
            unlink("fotos_viviendas/{$nombreArchivo}");
        }
    
    }
if(isset($resultado)){
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-<?= $resultado ? 'success' : 'danger' ?>" role='alert'>
                <?= $mensaje?>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
