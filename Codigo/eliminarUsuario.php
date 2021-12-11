<?php
require 'BD/ConectorBD.PHP';
require 'BD/DAOUsuario.PHP';
require 'BD/DAOProducto.PHP';
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
    <?php include 'nav.php'; ?>
</head>
<body>
    <?php
if (isset($_POST['Eliminar'])) {

  $fecha=date('Y-m-d H:i:s');
$conUsu=UsuarioProductos($conexion,$_POST['usuElimi'],$fecha);

if(mysqli_num_rows($conUsu)>=1){
    $usuModify=consultaUsuarioId($conexion,$_POST['usuElimi']);
    $usMo=mysqli_fetch_assoc($usuModify);
   ?>
   <div class="card">
  <div class="card-header">
    Error
  </div>
  <div class="card-body">
    <h5 class="card-title">El usuario <?php echo $usMo['usuario']; ?> a eliminar tiene articulos pendientes de Venta, Elimine los articulos en subasta de este usuario o espere a que termine para eliminarlo</h5>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de administracion</a>
  </div>
</div>
   <?php
}else{
    $usuModify=consultaUsuarioId($conexion,$_POST['usuElimi']);
$usMo=mysqli_fetch_assoc($usuModify);
echo $_POST['usuElimi'];
    ?>
    <div class="card">
   <div class="card-header">
     Error
   </div>
   <div class="card-body">
     <h5 class="card-title">¿Esta seguro que desea eliminar el usuario <?php echo $usMo['usuario']; ?> ?</h5>
     <form action="adminUsuario.php" method="POST">
         <input type="hidden" name="el" value="<?php echo $_POST['usuElimi']; ?>">
<input type="submit" value="Enviar" name="subElim">
</form>

        <?php
    
}
?>
   </div>
 </div>
    <?php
}else{
  $fecha=date('Y-m-d H:i:s');
  $con=consultaProductoPorIdUsuario($conexion,$_SESSION['idUsuario']);
  $productosFinalizados=0;
  $productosEnSubastaEnLaRestric=0;
  while($usuPro=mysqli_fetch_assoc($con)){
    $fechaIni=$usuPro['fechaIni'];
    $fechaFin=$usuPro['fechaFin'];
    $fechaFinMasRestric= date("Y-m-d H:i:s",strtotime($fechaFin."- 15 Day"));
    
    if ($fecha>$fechaFinMasRestric) {
      $productosFinalizados+=1;
    }elseif ($fecha<$fechaFinMasRestric) {
      $productosEnSubastaEnLaRestric+=1;
      
    }
  }
  if ($productosEnSubastaEnLaRestric>0) {
    ?>
   <div class="card">
  <div class="card-header">
    Tu usuario no se puede eliminar
  </div>
  <div class="card-body">
    <h5 class="card-title">tienes <?php echo $productosEnSubastaEnLaRestric; ?> producto/s en subasta o en proceso de pago</h5>
    <a href="Principal.php" class="btn btn-primary">Volver a la pagina principal</a>
  </div>
</div>
   <?php
  }else {
    ?>
            <div class="card">
                <div class="card-header">
                Esta seguro que desea eliminar el usuario <?php echo $_SESSION['nombre'] ?>
                </div>
                <div class="card-body">
                    <form action="eliminarUsuario.php" method="post">
           
           <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>">
           <input type="hidden" name="usu" value="<?php echo $_SESSION['usuario'] ?>">
           <input class="btn btn-danger" type="submit" value="Eliminar" name="confEliminarUsu">
           </form>
                </div>
            </div>
            <?php 
  }
}
if (isset($_POST['confEliminarUsu'])) {
  $resulEliminUsu=eliminarUsuario($conexion,$_SESSION['idUsuario']);
  if ($resulEliminUsu) {
    ?>
    <div class="card">
  <div class="card-header">
    Proceso correcto
  </div>
  <div class="card-body">
    <h5 class="card-title">El usuario se elimino correctamente</h5>
    <a href="principal.php" class="btn btn-primary">Volver a pagina principal</a>
  </div>
</div>
    <?php
    session_start();
    session_destroy();
    header("Location: principal.php");
  }else{
    ?>
    <div class="card">
  <div class="card-header">
    Error
  </div>
  <div class="card-body">
    <h5 class="card-title">No se pudo eliminar el usuario</h5>
    <a href="principal.php" class="btn btn-primary">Volver a pagina principal</a>
  </div>
</div>
    <?php
  
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