<?php
        //Lo primero debemos incluir el fichero donde esta el conector
        require 'ConectorBD.php';
        echo "Se ha cargado correctamente el archivo <br>";

        //Queremos conectarnos con la BD. 
        $conexion = conectar(false);
        $consulta = "SELECT * FROM usuario";

if (!$resultado = $conexion->query($consulta)) {
    echo "Lo sentimos, no se pudo realizar la consulta.";
    exit;
}

echo "<table><tr><th>Usuario</th><th>Clave</th></tr>";
while ($array_registro = $resultado->fetch_assoc()) {
    echo $array_registro['idUsuario']." ".$array_registro['nombre']."<br>";
}
echo "</table>";

$resultado->free(); 
$conexion->close();

?>
