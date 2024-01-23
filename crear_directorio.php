<?php 

//crear directorio en el servidor

$directorio ="foto_viviendas":
$ruta_destino_archivo="$directorio/$filename";

if(!file_exists($directorio)){
    mkdir($directorio,0777) or die("No se puede crear el directorio de extraccion";)
}
$dir=opendir($directorio);
if(move_uploaded_file($ruta_temporal,$ruta_destino_archivo)){
    echo "El archivo $filename se ha almacenado en $directorio.<br>";
}
closedir($dir);

//comentario de prueba

?>