<?php
function consultaProductos($conexion){
    $consulta = "select * from seccion inner join producto inner join usuario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function buscador($conexion,$q){
    $consulta = "select * from seccion inner join producto inner join usuario where seccion.nombre LIKE '%".$q."%'";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function modificarPro($conexion,$producto,$campo,$nuevo){
    $consulta = "UPDATE producto SET $campo = '$nuevo' WHERE `idProducto` = $producto";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaProductosEnSubasta($conexion,$fecha){
    $consulta = "select DISTINCT * from seccion inner join producto WHERE producto.idSeccion=seccion.idSeccion AND '$fecha' BETWEEN producto.fechaIni AND producto.fechaFin;";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaProductosEnSubastaPorSecciones($conexion,$fecha,$idSeccion){
    $consulta = "select DISTINCT * from seccion inner join producto WHERE producto.idSeccion=seccion.idSeccion AND '$fecha' BETWEEN producto.fechaIni AND producto.fechaFin and seccion.idSeccion=$idSeccion;";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaProductosEnSubastaPorVendedor($conexion,$fecha,$idusuario){
    $consulta = "select DISTINCT * from seccion inner join producto WHERE producto.idSeccion=seccion.idSeccion AND '$fecha' BETWEEN producto.fechaIni AND producto.fechaFin and producto.idUsuario='$idusuario';";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaTodosProductos($conexion){
    $consulta = "select DISTINCT * from seccion inner join  usuario inner join producto WHERE producto.idSeccion=seccion.idSeccion and usuario.idUsuario=producto.idUsuario;";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaProductoPorId($conexion,$idPr){
    $consulta = "select DISTINCT * from seccion inner join  usuario inner join producto WHERE producto.idSeccion=seccion.idSeccion and usuario.idUsuario=producto.idUsuario and idProducto=$idPr;";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaProductoPorIdUsuario($conexion,$id){
    $consulta = "select DISTINCT * from seccion inner join usuario inner join producto WHERE producto.idSeccion=seccion.idSeccion and usuario.idUsuario=producto.idUsuario and producto.idUsuario='$id';";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function todasLasPujasDeUsuario($conexion,$id){
    $consulta = "SELECT DISTINCT * FROM usuario inner join puja inner join producto where puja.idUsuario=usuario.idUsuario and puja.idProducto=producto.idProducto AND puja.idUsuario=$id";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function insertarProducto($conexion,$idUsuario,$fechaIni,$fechaFin,$precioInicial,$idSeccion,$proImagen,$Descripcion,$titulo,$precioEnvio){
    $consulta = "INSERT INTO `producto` (`idUsuario`, `fechaIni`, `fechaFin`, `precioInicial`, `idSeccion`, `proImagen`, `Descripcion`, `titulo`, `precioEnvio`) VALUES ('$idUsuario', '$fechaIni', '$fechaFin', '$precioInicial', '$idSeccion', '$proImagen', '$Descripcion', '$titulo', $precioEnvio);";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaMaximaPujaProductos($conexion,$idproducto){
    $consulta = "select max(valor),idUsuario from puja where idProducto=$idproducto";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaUltimaInsercion($conexion,$idproducto){
    $consulta = "select * from producto ORDER BY idProducto DESC LIMIT 1";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function eliminarProducto($conexion,$idproducto){
    $consulta = "DELETE FROM `producto` WHERE `producto`.`idProducto` = $idproducto";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function insertarPuja($conexion,$idUsuario,$idProducto,$fecha,$valor){
    $consulta = "INSERT INTO puja (idUsuario,idProducto,fecha,valor) VALUES ('$idUsuario','$idProducto','$fecha','$valor')";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
?>