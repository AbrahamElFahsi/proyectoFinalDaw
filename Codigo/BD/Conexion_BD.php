<?php
        //Lo primero debemos incluir el fichero donde esta el conector
        require 'ConectorBD.php';
        echo "Se ha cargado correctamente el archivo <br>";

        //Queremos conectarnos con la BD. 
        $conexion = conectar(false);
        require 'DAOUsuario.php';
        $usu=consultaUsuario($conexion,1);
        $p=mysqli_fetch_assoc($usu);
        echo $p['usuario'];

?>
