<?php

    //Creamos una funcion llamada conectar(), para conectarnos a la BD
    function conectar($remota){
        //echo "Vamos a intentar conectarnos a la BD <br>";
        //Leemos la variable $remota para determinar donde me conecto, local o AMW
        if ($remota){
            $servidor = "";
        } else{
            //La conexion es local
            $servidor = "localhost:3306";
        }
        //Guardamos los datos para de conexion a la BD
        //Valor del usuario
        $usuario = "debianDB";
        //Contraseña del usuario
        $password = "debianDB";
        //Esquema de BD
        $BD = "tiendacompraventa";

        //Realizamos la conexión de la BD con la función mysqli_connect()
        $conexion = new mysqli("127.0.0.1", $usuario, $password, $BD,3306);

        //$conexion = mysqli_connect($servidor,$usuario,$password,$BD);
        if ($conexion->connect_errno){
            echo "Error MYSQL";
            return false;
        } else {
            echo "La conexión se ha realizado con exito. <br>";
            return $conexion;
        }
    }

?>
