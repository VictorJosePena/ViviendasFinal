<?php

header("Content-Type: text/html;charset=utf-8");
include_once "FuncionesConex/funcionesConexion.php" ;
include_once "FuncionesConex/funcionesModYBorrar.php" ;
include_once "FuncionesConex/funciones.php" ;

function modificarViviendas(){
    $conexion=conectar();
    if($conexion){
        mysqli_set_charset($conexion,'utf8');
        $modificar=$_POST['modificar'];



        $query ="SELECT * FROM viviendas where id ='$modificar'";
    
        $consulta=mysqli_query($conexion, $query);

        if($consulta){
            $linea = mysqli_fetch_array($consulta, MYSQLI_ASSOC);
               
            print("<form method='post' action='validar_formmodificar.php' enctype='multipart/form-data'>");

                echo '<input id="pasoId" name="pasoId" type="hidden"  value="'. $linea["id"] .'" >';

                $sel=$linea["tipo"];
                $enum=cargarEnum($conexion, 'viviendas', 'tipo');
                echo '<div class="form-group">
                <label for="tipo">Tipo de vivienda</label>
                <select name="tipo" id="tipo"  class="form-control">';
                for($i=0;$i<count($enum); $i++){
                    $cad = trim($enum[$i],"'");// quito las comillas simple porque me llega doble.
                    echo '<option value='. $cad .' ' .(($sel== $cad)?'selected="selected"':""). '> ' . $cad .' </option>';
                }
                echo '</select>
                    </div>';

                $sel=$linea["zona"];
                $enum=cargarEnum($conexion, 'viviendas', 'zona');
                echo '<div class="form-group">
                <label for="zona">Zona</label>
                <select name="zona" id="zona"  class="form-control">';
                for($i=0;$i<count($enum); $i++){
                    $cad = trim($enum[$i],"'");// quito las comillas simple porque me llega doble.
                    echo '<option value='. $cad .' ' .(($sel== $cad)?'selected="selected"':""). '> ' . $cad .' </option>';
                }
                echo '</select>
                    </div>';


                echo '<div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="direccion" name="direccion" id="direccion" value="'. $linea["direccion"] .'" class="form-control">
                </div>';

                $ndor=$linea["ndomitorios"];
                
                echo '<div class="form-group">
                    <label for="ndormitorios">Seleciona el numero de dormitorios</label><br>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio0" value="1"'. (($ndor == 1)?'CHECKED':"").'>
                    <label class="form-check-label" for="inlineRadio1">Sin dormitorios</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio1" value="2"'. (($ndor == 2)?'CHECKED':"").'>
                    <label class="form-check-label" for="inlineRadio2">Uno</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio2" value="3"'. (($ndor == 3)?'CHECKED':"").' >
                    <label class="form-check-label" for="inlineRadio3">Dos</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio3" value="4"'. (($ndor == 4)?'CHECKED':"").' >
                    <label class="form-check-label" for="inlineRadio3">Tres</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio4" value="5"'. (($ndor == 5)?'CHECKED':"").' >
                    <label class="form-check-label" for="inlineRadio3">Cuatro</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ndormitorios" id="Radio5" value="6"'. (($ndor == 6)?'CHECKED':"").' >
                    <label class="form-check-label" for="inlineRadio3">Cinco</label>
                    </div>
                    </div>';

                echo '<div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio"  value="'. $linea["precio"] .'" class="form-control">
                </div>';
                echo '<div class="form-group">
                    <label for="tamano">Tamaño</label>
                    <input type="text" name="tamano" id="tamano"  value="'. $linea["tamano"] .'" class="form-control">
                </div>';

                $ex=$linea["extras"];
                echo '<div class="form-group">
                <label for="tamano">Seleciona los Extras</label>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Piscina" '.((strpos($ex,"Piscina")!==false)? 'CHECKED':"").' id="defaultCheck1" name="extras[]">
                <label class="form-check-label" for="defaultCheck1">
                    Piscina
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Jardin" '.((strpos($ex,"Jardin")!==false)? 'CHECKED':"").' id="defaultCheck2" name="extras[]">
                <label class="form-check-label" for="defaultCheck2">
                    Jardin
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Garaje" '.((strpos($ex,"Garaje")!==false)? 'CHECKED':"").' id="defaultCheck2" name="extras[]" >
                <label class="form-check-label" for="defaultCheck2">
                    Garaje
                </label>
                </div>
            </div>';
            
            if($linea['foto']==""){
                $fotoreg="";
            }else{
                $fotoreg=$linea["foto"];
            }

            echo '<div class="form-group">
                    <label for="archivo">Seleciona un archivo:</label>
                    <input type="text" name="archivoDB" value="' . $fotoreg .'" readonly>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                </div>';
                echo '<div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" name="observaciones" id="observaciones"  value="'. $linea["observaciones"] .'" class="form-control">
                </div>';
                echo '<div class="form-group justify-content-md-end mt-3">
                    <input id="enviar" type="submit" name="finModificar" class="btn btn-outline-primary" value="Modificar Datos" >
                </div>
            </form>';

        }

        desconectar($conexion);
    }else{
    $resultado =true;
    $mensaje="hay algun problema al conectar al BD <br>";
    mysqli_connect_error();
    }
}

function eliminarVivienda(){


    $conexion=conectar();
    if($conexion){
        mysqli_set_charset($conexion,'utf8');
    
        $borrar=$_POST['borrar'];


    //obtengo los datos de los alumnos eliminados y seguidamente
    

        $query = "SELECT * FROM viviendas where id = $borrar";
        $consulta = mysqli_query($conexion,$query);
        $resultado = mysqli_fetch_array($consulta,  MYSQLI_ASSOC);
        $nombreArc=$resultado['foto'];

        print("<form action='volverOeliminar.php' method='post' autocomplete='off'>");
        
        print("<ul class='list-group'>");
        print("<li class='list-group-item active' aria-current='true'> ID:" . $resultado['id'] . "</li>");
        print("<li class='list-group-item'>Nombre:" . $resultado['tipo'] . "</li>");
        print("<li class='list-group-item'>Apellido:" . $resultado['zona'] . "</li>");
        print("<li class='list-group-item'>Correo:" . $resultado['direccion'] . "</li>");
        print("<li class='list-group-item'>Teléfono:" . $resultado['ndomitorios'] . "</li>");
        print("<li class='list-group-item'>Sueldo:" . $resultado['precio'] . "</li>");
        print("<li class='list-group-item'>Tamaño:" . $resultado['tamano'] . "</li>");
        print("<li class='list-group-item'>Extras:" . $resultado['extras'] . "</li>");
        print("<li class='list-group-item'>Foto:" . $resultado['foto'] . "</li>");
        print("<li class='list-group-item'>Observaciones:" . $resultado['observaciones'] . "</li>");
        print("</ul>");

        print("<p class='pt-5' style='font-weight:bolder;'>¿Esta seguro que desea borrar esta vivienda?</p><br>");
        print("<button class='btn btn-warning' type='submit' name='volver'>Deseo volver</button>");
        print("<button class='btn btn-danger' style='margin-left:10px;' type='submit' value='". $resultado['id']. "' name='eliminar'>Eliminar registro</button>");
  
        


        
                    

        desconectar($conexion);

    }else{
        $resultado =true;
        $mensaje="hay algun problema al conectar al BD <br>";
        mysqli_connect_error();
    }
  
        
}
?>
