<?php
require 'BD/ConectorBD.PHP';
require 'BD/DAOUsuario.PHP';
require 'BD/DAOProducto.PHP';
require 'BD/DAOSeccion.PHP';
$conexion=conectar(false);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="ajax.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <?php include 'nav.php'; ?>
</head>
<body style="background-color: rgba(203, 216, 252, 0.603);">
<div class="col-12 text-center"><h1 style="font-family: 'Tangerine', cursive;">Panel de Administracion de Producto</h1></div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Listar Productos
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
        <div class="col-12 text-center"><h1 style="font-family: 'Tangerine', cursive;">Listar Productos</h1></div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">idProducto</th>
      <th scope="col">usuario</th>
      <th scope="col">Articulo</th>
      <th scope="col">fechaIni</th>
      <th scope="col">fechaFin</th>
      <th scope="col">precioInicial</th>
      <th scope="col">nombreSec</th>
      <th scope="col">direccion</th>
      <th scope="col">info</th>
      <th scope="col">Puja ganadora</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $producto=consultaTodosProductos($conexion);
        While($product=mysqli_fetch_assoc($producto)){
            $puj=consultaMaximaPujaProductos($conexion,$product['idProducto']);
            $PujaMax=mysqli_fetch_assoc($puj);
      ?>
    <tr>
      <th scope="row"><?php echo $product['idProducto']; ?></th>
      <td><?php echo $product['usuario']; ?></td>
      <td><?php echo $product['titulo']; ?></td>
      <td><?php echo $product['nombre']; ?></td>
      <td><?php echo $product['fechaIni']; ?></td>
      <td><?php echo $product['fechaFin']; ?></td>
      <td><?php echo $product['precioInicial']; ?></td>
      <td><?php echo $product['nombreSec']; ?></td>
      <td><?php echo $product['info']; ?></td>
      <?php
        if ($PujaMax['max(valor)']!=null) {
            ?>
            <td><?php echo $PujaMax['max(valor)']; ?> Euros</td>
            <?php
        }else{
      ?>
      <td>Sin Pujas</td>
      <?php
}
      ?>
    </tr>
    <?php

        }
      ?>
  </tbody>
</table>
  </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Crear Producto
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
        <div class="col-12 text-center"><h1 style="font-family: 'Tangerine', cursive;">Crear Producto</h1></div>
    <form class="row" action="admin.php" method="POST" name="formulario" enctype="multipart/form-data">
        <div class="form-group col-6">
            <label for="articulo">Nombre del articulo <i class="fas fa-user"></i></label>
            <input type="text" id="articulo" name="articulo" class="form-control" placeholder="Enter User"> 
        </div>
        <div class="form-group col-12">
            <label for="precio">Precio de salida<i class="fas fa-lock"></i></label>
            <input type="number" name="precioEnvio" step="0.1" maxlength="4" class="form-control" placeholder="precio de salida">
        </div>
        <div class="form-group col-6">
            <label for="precio">Precio de salida<i class="fas fa-lock"></i></label>
            <input type="number" name="precio" step="0.1" maxlength="4" class="form-control" placeholder="Envio">
        </div>
        <div class="form-group col-6">
        Añadir imagen: <input name="archivo" id="archivo" type="file"/>
        </div>
        

        <div class="form-group col-6">
            <label for="Descripcion">Descripcion</label>
            <textarea name="Descripcion" maxlength="50" rows="3" cols="30"></textarea>
        </div>
        <div class="form-group col-12">
    <label for="dias">Dias de subasta: <span id="demo"></label>
  <input type="range" min="1" max="10" value="5" name="dias" id="myRange">
</div>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
        <div class="form-group col-6">
            <label for="seccion">Seccion<i class="fas fa-user-tag"></i></label>
            <select name="seccion" id="seccion">
                    <option value="0">Identificador-Usuario</option>
                    <?php
                            $Sec=consultaSeccion($conexion);
                            While($seccion=mysqli_fetch_assoc($Sec)){
                        ?>
                    <option value="<?php echo $seccion['idSeccion']; ?>"><?php echo $seccion['nombreSec']; ?></option>
                    


                    <?php
                }
?>
        </div>
        <div class="col-12"><input name="crearPro" type="submit" value="Enviar"></div>
    </form>
    </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Modificar Producto
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
        <div class="col-12 text-center"><h1 style="font-family: 'Tangerine', cursive;">Modificar producto</h1></div>
  <form action="admin.php" method="POST">
  <select name="proMody" id="proMody">
  <option value="0">Identificador-Producto-Usuario</option>
  <?php
        $prod=consultaTodosProductos($conexion);
        While($pro=mysqli_fetch_assoc($prod)){
      ?>
<option value="<?php echo $pro['idProducto']; ?>"><?php echo $pro['idProducto']."-".$pro['titulo']; ?></option>
  
<?php
        }
?>
</select>
<input type="submit" value="Modificar Producto" name="modiProduct">

</form>

  </div>
</div>
<div class="dropdown" style="margin-bottom: 500px;">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Eliminar Producto
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
        <div class="col-12 text-center"><h1 style="font-family: 'Tangerine', cursive;">Eliminar producto</h1></div>
  <form action="admin.php" method="POST">
  <select name="proElim" id="proElim">
  <option value="0">Identificador-Producto-Usuario</option>
  <?php
        $prod=consultaTodosProductos($conexion);
        While($pro=mysqli_fetch_assoc($prod)){
      ?>
<option value="<?php echo $pro['idProducto']; ?>"><?php echo $pro['idProducto']."-".$pro['titulo']; ?></option>
  
<?php
        }
?>
</select>
<input type="submit" value="Modificar Usuario" name="EliminarPro">
</form>
  </div>
</div>
<?php
if (isset($_POST['modiProd'])) {
    $articulo=$_POST['articulo'];
    if ($_POST['articulo']!="" && $_POST['articulo']!=null) {
        $resulModiPro=modificarPro($conexion,$_POST['idPro'],"titulo",$_POST['articulo']);
        if ($resulModiPro) {
            ?>
    <div class="card">
        <div class="card-header">
            Se modifico correctamente El titulo a <?php echo $_POST['articulo']; ?>
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }else{
            ?>
    <div class="card">
        <div class="card-header">
            Hubo un problema al modificar el producto
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }
    }
    //Precio
    if ($_POST['precio']!="" && $_POST['precio']!=null) {
        $resulModiPro=modificarPro($conexion,$_POST['idPro'],"precioInicial",$_POST['precio']);
        if ($resulModiPro) {
            ?>
    <div class="card">
        <div class="card-header">
            Se modifico correctamente El precio inicial a <?php echo $_POST['precio']; ?>
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }else{
            ?>
    <div class="card">
        <div class="card-header">
            Hubo un problema al modificar el producto
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }
    }
    //archivo
    $archivo = $_FILES['archivo']['name'];
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
       if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
          echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
          - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
       }
       else {
          //Si la imagen es correcta en tamaño y tipo
          //Se intenta subir al servidor
          if (move_uploaded_file($temp, 'images/'.$archivo)) {
              //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
              chmod('images/'.$archivo, 0777);
              //Mostramos el mensaje de que se ha subido co éxito
              echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
          }
          else {
             //Si no se ha podido subir la imagen, mostramos un mensaje de error
             echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
          }
        }
        $ubiArchivo="images/$archivo";
        $resulModiPro=modificarPro($conexion,$_POST['idPro'],"proImagen",$ubiArchivo);
        if ($resulModiPro) {
            ?>
    <div class="card">
        <div class="card-header">
            Se modifico correctamente la imagen a <img src="images/<?php echo $archivo; ?>">
        
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }else{
            ?>
    <div class="card">
        <div class="card-header">
            Hubo un problema al modificar el producto
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }
     }
     //Descripcion
     if ($_POST['Descripcion']!="" && $_POST['Descripcion']!=null) {
        $resulModiPro=modificarPro($conexion,$_POST['idPro'],"Descripcion",$_POST['Descripcion']);
        if ($resulModiPro) {
            ?>
    <div class="card">
        <div class="card-header">
            Se modifico correctamente El precio inicial a <?php echo $_POST['Descripcion']; ?>
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }else{
            ?>
    <div class="card">
        <div class="card-header">
            Hubo un problema al modificar el producto
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }
    }
    //Seccion
    if ($_POST['seccion']!="" && $_POST['seccion']!=null) {
        $resulModiPro=modificarPro($conexion,$_POST['idPro'],"idSeccion",$_POST['seccion']);
        if ($resulModiPro) {
            ?>
    <div class="card">
        <div class="card-header">
            Se modifico correctamente
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }else{
            ?>
    <div class="card">
        <div class="card-header">
            Hubo un problema al modificar el producto
        </div>
        <div class="card-body">
            <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
        }
    }
}
//Eliminar Producto Interaccion
if (isset($_POST['confEliminar'])) {
    echo $_POST['idProducto'];
    $eliminarPro=eliminarProducto($conexion,$_POST['idProducto']);
    if ($eliminarPro) {
        ?>
            <div class="card">
                <div class="card-header">
            Se elimino correctamente el articulo <?php echo $_POST['titu']; ?>
                </div>
                <div class="card-body">
                    
                    <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
                </div>
            </div>
            <?php 

    }else{
        ?>
            <div class="card">
                <div class="card-header">
            Hubo un error al eliminar el articulo
                </div>
                <div class="card-body">
                    
                    <a href="adminProducto.php" class="btn btn-primary">Eliminar mensaje</a>
                </div>
            </div>
            <?php 
    }
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>