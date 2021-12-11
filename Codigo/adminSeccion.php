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
<body  style="background-color: rgba(203, 216, 252, 0.603);">
<div class="col-12 text-center"><h1>Panel de Administracion de Secciones</h1></div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Listar Secciones
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
            <div class="col-12 text-center"><h1>Listar Secciones</h1></div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">identificador de la seccion</th>
      <th scope="col">Nombre de la seccion</th>
      <th scope="col">Información</th>
      <th scope="col">Imagen</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $secciones=consultaSeccion($conexion);
        while($sec=mysqli_fetch_assoc($secciones)){
      ?>
    <tr>
      <th scope="row"><?php echo $sec['idSeccion']; ?></th>
      <td><?php echo $sec['nombreSec']; ?></td>
      <td><?php echo $sec['info']; ?></td>
      <td><?php echo $sec['image']; ?></td>
      
      <?php
}
      ?>
    </tr>
   
  </tbody>
</table>
  </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Crear Seccion
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
                <div class="col-12 text-center"><h1>Crear Seccion</h1></div>
  <form class="row" action="admin.php" method="POST" name="formulario" enctype="multipart/form-data">
        <div class="form-group col-6">
            <label for="seccion">Nombre del sección <i class="fas fa-user"></i></label>
            <input type="text" id="seccion" name="seccion" class="form-control" placeholder="Enter User"> 
        </div>
        <div class="form-group col-6">
        Añadir imagen: <input name="archivo" id="archivo" type="file"/>
        </div>
        

        <div class="form-group col-6">
            <label for="informacion">informacion</label>
            <textarea name="informacion" maxlength="50" rows="3" cols="30"></textarea>
        </div>
        <div class="col-12"><input name="crearSec" type="submit" value="Enviar"></div>
    </form>
    </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Modificar Seccion
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
                <div class="col-12 text-center"><h1>Modificar Secciones</h1></div>
  <form action="admin.php" method="POST">
  <select name="secMody" id="secMody">
  <option value="0">Identificador-Producto-Usuario</option>
  <?php
        $secc=consultaSeccion($conexion);
        While($secciones=mysqli_fetch_assoc($secc)){
      ?>
<option value="<?php echo $secciones['idSeccion']; ?>"><?php echo $secciones['idSeccion']."-".$secciones['nombreSec']; ?></option>
  
<?php
        }
?>
</select>
<input type="submit" value="Modificar Sección" name="modificarSeccion">

</form>

  </div>
</div>
<div class="dropdown"  style="margin-bottom: 500px;">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Eliminar Seccion
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
                <div class="col-12 text-center"><h1>Eliminar Secciones</h1></div>
  <form action="adminSeccion.php" method="POST">
  <select name="EliSecMody" id="EliSecMody">
  <option value="0">Identificador-Producto-Usuario</option>
  <?php
        $secc=consultaSeccion($conexion);
        While($secciones=mysqli_fetch_assoc($secc)){
      ?>
<option value="<?php echo $secciones['idSeccion']; ?>"><?php echo $secciones['idSeccion']."-".$secciones['nombreSec']; ?></option>
  
<?php
        }
?>
</select>
<input type="submit" value="Eliminar Sección" name="elimiSeccion">

</form>

  </div>
</div>

    <?php
    //Eliminar Seccion
    if (isset($_POST['elimiSeccion'])) {
        echo $_POST['EliSecMody'];
        ?>
    <div class="card">
        <div class="card-header">
            ¿Estas seguro?
        </div>
        <div class="card-body">
            <h5 class="card-title">Si elimina esta seccion sus productos solo seran visibles cuando seleccione todos los productos</h5>
           <form action="adminSeccion.php" method="post">
           
           <input type="hidden" name="idSeccion" value="<?php echo $_POST['EliSecMody']; ?>">
           <input class="btn btn-danger" type="submit" value="Eliminar" name="confEliminarSec">   
        </form>
        </div>
    </div>
    <?php
       
    }
    if (isset($_POST['confEliminarSec'])) {
        echo $_POST['idSeccion'];
        $resulEliminar=eliminarseccion($conexion,$_POST['idSeccion']);
        if ($resulEliminar) {
            ?>
    <div class="card">
        <div class="card-header">
            Se elimino correctamente
        </div>
        <div class="card-body">
        <a href="adminSeccion.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php
        }else{
            ?>
            <div class="card">
                <div class="card-header">
                    Hubo un error
                </div>
                <div class="card-body">
                <a href="adminSeccion.php" class="btn btn-primary">Eliminar mensaje</a>
                </div>
            </div>
            <?php
        }
    } 
    //modificar seccion
if (isset($_POST['modificarSeccion'])) {
    echo $_POST['idSeccMo'];
    if ($_POST['seccionN']!="" && $_POST['seccionN']!=null) {;
        $resulMo=modificarSeccion($conexion,$_POST['idSeccMo'],"nombreSec",$_POST['seccionN']);
        if ($resulMo) {
            
        
    ?>
    <div class="card">
    <div class="card-header">
    Modificación
    </div>
    <div class="card-body">
    <p class="card-text">Se modifico Corectamente el nombre de la seccion a <?php echo $_POST['seccionN']; ?></p>
    
        <a href="adminSeccion.php" class="btn btn-primary">Volver al panel de Usuario</a>    
    <?php } 
    }
$archivo = $_FILES['archivoSm']['name'];
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivoSm']['type'];
      $tamano = $_FILES['archivoSm']['size'];
      $temp = $_FILES['archivoSm']['tmp_name'];
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
      $resulMod=modificarSeccion($conexion,$_POST['idSeccMo'],"image",$ubiArchivo);
      if ($resulMod) {
         
     
      ?>
      <div class="card">
      <div class="card-header">
      Modificación
      </div>
      <div class="card-body">
      <p class="card-text">Se modifico Corectamente la imagen <?php echo $archivo; ?></p>

          <a href="adminSeccion.php" class="btn btn-primary">Volver al panel de Usuario</a>    
      <?php
       }else{
           
      ?>
      <div class="card">
      <div class="card-header">
      Modificación
      </div>
      <div class="card-body">
      <p class="card-text">Hubo un erro al subir la imagen</p>

          <a href="adminSeccion.php" class="btn btn-primary">Volver al panel de Usuario</a>    
      <?php
       }
}
if ($_POST['informacion']!="" && $_POST['informacion']!=null) {;
    $resulMo=modificarSeccion($conexion,$_POST['idSeccMo'],"info",$_POST['informacion']);
    if ($resulMo) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente la informacion de la seccion a <?php echo $_POST['informacion']; ?></p>

    <a href="adminSeccion.php" class="btn btn-primary">Volver al panel de Usuario</a>    
<?php 
}
}
}

?>
<?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>