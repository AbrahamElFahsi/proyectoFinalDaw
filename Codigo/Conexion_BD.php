<?php
        //Lo primero debemos incluir el fichero donde esta el conector
        require 'ConectorBD.php';
        require 'daousuario.php';
        echo "Se ha cargado correctamente el archivo <br>";

        //Queremos conectarnos con la BD. 
        $conexion = conectar(false);
        $consulta = "SELECT * FROM usuario";

$resultado=todosUsuarios($conexion);
while ($array_registro = $resultado->fetch_assoc()) {
    echo $array_registro['idUsuario']." ".$array_registro['nombre']."<br>";
}

$resultado->free(); 
$conexion->close();

?>
