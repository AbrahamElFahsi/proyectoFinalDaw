<?php

function consultaTodosComentarios($conexion){
    $consulta = "SELECT * FROM comentario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaComentarioPorId($conexion,$idComen){
    $consulta = "SELECT * FROM comentario INNER join usuario where usuario.idUsuario=comentario.idUsuario AND comentario.idProducto=$idComen";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function insertarComentario($conexion,$idUsuario,$contenido,$idProducto,$fecha){
    $consulta = "INSERT INTO comentario(idUsuario,contenido,idProducto,fecha) VALUES ('$idUsuario','$contenido','$idProducto','$fecha');";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function modificarComentario($conexion,$comentario,$campo,$nuevo){
    $consulta = "UPDATE comentario SET $campo = '$nuevo' WHERE `idComentario` = $comentario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function eliminarComentario($conexion,$idComentario){
    $consulta = "DELETE FROM `comentario` WHERE `comentario`.`idComentario` = $idComentario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
?>