<?php
//FUNCIONES
function filtrado($datos){
    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}//Cierra funcion


function arrayACadena($arr){
    $resultado=$arr.join(",");
    return $resultado;
}

function saberProximaID(){
    $dev;
    $conexion=conectar();
    if($conexion){
        //mysqli_set_charset($conexion,'utf8');
        $conexion->set_charset("utf8mb4");
        try {
            $query= "SELECT max(id) as maxID FROM viviendas";
            $resul=$conexion->query($query);
            $dev=$resul;
    
    
            $dev->free(); 
            return $dev;
            
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
}



function cargarEnum($conexion, $tabla, $campo){
 
    $dev=0;    
    $query = "SHOW columns FROM $tabla LIKE '$campo'";
        
        $consulta = mysqli_query($conexion,$query) ;
        if ($consulta)
        {
            $fila = mysqli_fetch_row($consulta);
            
            $lis = strstr ($fila[1], "(");
            $lis = ltrim ($lis, "(");
            $lis = rtrim ($lis, ")");
            $lista = explode (",", $lis);
            $dev=$lista;
            mysqli_free_result($consulta);
            
        }
        return $dev;   
}



?>