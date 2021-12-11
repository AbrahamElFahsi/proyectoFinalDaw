<?php
function todosUsuarios($conexion){
    $consulta = "Select * from Usuario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function UsuarioProductos($conexion,$id,$fecha){
    $consulta = "select DISTINCT * from seccion inner join producto WHERE producto.idUsuario=$id AND '$fecha' BETWEEN producto.fechaIni AND producto.fechaFin;";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function modificar($conexion,$usuario,$campo,$nuevo){
    $consulta = "UPDATE usuario SET $campo = '$nuevo' WHERE `idUsuario` = $usuario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaLogin($conexion,$usuario,$password){
    $consulta = "Select * from Usuario WHERE  usuario = '$usuario' AND password = '$password' ";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function insertarUsuarioComple($conexion,$usuario, $password, $nombre, $apellidos, $dni, $comunidad, $provincia, $cp, $direccion, $Rol, $telefono, $email){
    $consulta = "INSERT INTO usuario (usuario, password, nombre, apellidos, dni, comunidad, provincia, cp, direccion, Rol, telefono, email) VALUES ('$usuario', '$password', '$nombre', '$apellidos', '$dni', '$comunidad', '$provincia', '$cp', '$direccion', '$Rol', '$telefono', '$email') ";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaUsuario($conexion,$usuario){
    $consulta = "Select * from Usuario WHERE  usuario = '$usuario'";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaUsuarioId($conexion,$usuario){
    $consulta = "Select * from Usuario WHERE  idUsuario = '$usuario'";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaUltimoUsuario($conexion){
    $consulta = "select * from usuario ORDER BY idUsuario DESC LIMIT 1";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function eliminarUsuario($conexion,$usuario){
    
    $consulta1 = "DELETE FROM producto WHERE idUsuario='$usuario'";
    $resultado = mysqli_query($conexion,$consulta1);
    $consulta2 = "DELETE FROM comentario WHERE idUsuario='$usuario'";
    $resultado = mysqli_query($conexion,$consulta2);
    $consulta3 = "DELETE FROM puja WHERE idUsuario='$usuario'";
    $resultado = mysqli_query($conexion,$consulta3);
    $consulta = "DELETE FROM usuario WHERE idUsuario='$usuario'";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function crearUsuarioAdmin($conexion,$telefono,$email,$usuario,$contra,$nombre,$apellidos,$dni,$comunidad,$provincia,$cp,$direccion,$rol){
    $consulta = "INSERT INTO usuario (usuario, telefono, email, password, nombre, apellidos, dni, comunidad, provincia, cp, direccion, Rol) VALUES ('$usuario','$telefono','$email','$contra','$nombre','$apellidos','$dni','$comunidad','$provincia','$cp','$direccion','$rol');";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function crearSesion($usuario){
    //Queremos que el id de session sea su dni
    session_id($usuario['Usuario']);
    //Creamos la session
    session_start();
    //Almacenamos en la session los datos del usuario
    foreach($usuario as $indice=>$valor){
        $_SESSION[$indice] = $valor;
    }
}
function insertarUsuario($conexion,$usuario,$password,$nombre,$apellidos,$dni){
    $consulta = "insert into usuario (usuario,password,nombre,apellidos,dni) values ($usuario,$password,$nombre,$apellidos,$dni)";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
?>