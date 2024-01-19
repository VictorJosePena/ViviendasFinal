<?php
   // conectar();
    function conectar(){
        $host = "localhost";
        $usuario="root";
        $pw="1234";
        $BDconex = "inmobiliaria";
        

        try{
            
            $db = new mysqli($host,$usuario, $pw, $BDconex);
        }catch(mysqli_sql_exception $e){
            echo "<p>Ha habido una excepción: ". $e->getMessage() .  $conexion->connect_errno .  $conexion->connect_error ."</p>";
            $db = false;
        }

        return $db;
    }
    function desconectar($conexion){
        $desconectar = $conexion->close();

        if(!$desconectar){
            echo "<p>Error en la desconexion ". $conexion->connect_error."</p>";
        }
    }

    //leer cualquier tabla

    function consultaConTabla($resul){
  

        echo "<table class='table table-bordered table-striped table-hover text-center'>";

            echo "<thead>";

                echo "<tr>";

                    while($finfo = mysqli_fetch_field($resul)){
                        echo "<th>";
                        echo    $finfo->name;
                        echo "</th>";
                    }
                    echo "<th>Fotografía</th>";
                    echo "<th>Modificar</th>";
                    echo "<th>Eliminar</th>";
                    
                
                        
                       
                echo "</tr>";

            echo "</thead>";

            echo "<tbody>";

                while($linea = mysqli_fetch_array($resul, MYSQLI_ASSOC)){
                    echo "<tr>";
                      

                        foreach($linea as $col_valor){
                            echo "<td> $col_valor </td>";
                        }
                        if ($linea['foto'] != ""){
                            print ("<td class='text-center'><a target='_blank' href='fotos_viviendas/" . $linea['foto'] ."'> <img border='0' class='botones' src='img/foto.png' alt='Foto vivienda'></a></td>");
                        }else{
                            print ("<td>&nbsp;</td>");
                        }
                       
                        print("<td class='text-center'><button style='border:none;' type='submit' name='modificar' value='" .  $linea['Identificador'] .  "' ><img class='botones' src='img/editar.png'></button></td>");
                        print("<td class='text-center'><button style='border:none;' type='submit' name='borrar' value='" .  $linea['Identificador'] .  "' ><img class='botones' src='img/borrar.png'></button></td>");
                    

                    
                    echo "</tr>";
                }

            echo "</tbody>";
        
        echo "</table>";
   
    }

    function saberProximaId2(){
        $dev=0;
            try{
            
                $conexion = conectar(); 
    
                if(!$conexion) throw new Exception('Error de conexion a la Bd <br>');
                else 
                {               
                    $conexion->set_charset("utf8mb4");
                                            
                    $query = "select max(id) as maximo from viviendas";
                    $consulta = $conexion->query($query);
                    
                    if (!$consulta) throw new Exception('error al leer máximo <br>');
                    else {
                        $fila = $consulta->fetch_assoc();
                        //$fila = mysqli_fetch_assoc($consulta);
                        
                        $maxi = $fila['maximo'];
                        
                        //$consulta->free(); //libero la consulta
                        $consulta->close();  //cierro la consulta
    
                        $dev=$maxi+1;
                    }
    
                  desconectar($conexion) ; 
                    
                }
            }catch(Exception $e){            
                throw new Exception('error funcion maximoID --' . $e->getMessage() .  ' -- <br>');            
            }
        return $dev;
        
    }
    
    //borrar tablaa

   
?>