<?php
function consultaSeccion($conexion){
    $consulta = "select * from seccion";
    $resultado = $conexion->query($conexion,$consulta);
    return $resultado;
}
function consultaSeccionPorId($conexion,$idSeccion){
    $consulta = "select * from seccion where idSeccion=$idSeccion";
    $resultado = $conexion->query($consulta);
    return $resultado;
}
function insertarSeccion($conexion,$nombre,$info,$imagen){
    $consulta = "INSERT INTO seccion(nombreSec, info, image) VALUES ('$nombre','$info','$imagen')";
    $resultado = $conexion->query($consulta);
    return $resultado;
}
function modificarSeccion($conexion,$seccion,$campo,$nuevo){
    $consulta = "UPDATE seccion SET $campo = '$nuevo' WHERE `idSeccion` = $seccion";
    $resultado = $conexion->query($consulta);
    return $resultado;
}
function eliminarseccion($conexion,$idseccion){
    $consulta = "DELETE FROM seccion WHERE `seccion`.`idSeccion` = $idseccion";
    $resultado = $conexion->query($consulta);
    return $resultado;
}
?>