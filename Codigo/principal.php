<?php
require 'BD/ConectorBD.PHP';
require 'BD/DAOUsuario.PHP';
require 'BD/DAOProducto.PHP';
require 'BD/DAOSeccion.PHP';
require 'BD/DAOComentario.PHP';
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

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="ajax.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <?php include 'nav.php'; ?>
</head>
<body style="background-color: rgba(203, 216, 252, 0.603);height: inherit; min-height: 100%; width: 100%;">
<div class="container-fluid mb-5">


<div class="row">
    
          <h1 class="text-center col-12" class="col-12 text-center">Secciones</h1>
        </div>

<div id="carouselExampleFade" class="sombra col-12 carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
  
                        <?php
                          $secciones=consultaSeccion($conexion);
                          $contador=0;
                          while($seccion = mysqli_fetch_assoc($secciones)){
                            if($contador==0){
                           

                        ?>
          <div class="carousel-item active" style="height: 350px;">
      <img src="<?php echo $seccion['image']; ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="text-muted"><?php echo $seccion['nombreSec']; ?></h5>
        <form action="secciones.php" method="POST">
          <input type="hidden" name="seccion" value="<?php echo $seccion['idSeccion']; ?>">
          <input type="submit" class="btn btn-primary" value="Mostrar Informacion" name="filtrarSec">
        </form>
      </div>
    </div>
              <?php
             $contador++;
            }else{ ?>
                <div class="carousel-item"  style="height: 350px;">
      <img src="<?php echo $seccion['image']; ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5><?php echo $seccion['nombreSec']; ?></h5>
        <form action="secciones.php" method="POST">
          <input type="hidden" name="seccion" value="<?php echo $seccion['idSeccion']; ?>">
          <input type="submit" class="btn btn-primary" value="Mostrar Informacion" name="filtrarSec">
        </form>
      </div>
    </div>
    <?php
              }
            }
    ?>
              </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
 <h1 class="text-center col-12" class="estilo-x col-12 text-center">Productos en subasta</h1>
       <div class="row d-flex justify-content-center">
        <div class="col-12 d-flex flex-wrap">
       <?php
      $fecha=date('Y-m-d H:i:s');
        $productos=consultaProductosEnSubasta($conexion,$fecha);
        while ($pro=mysqli_fetch_assoc($productos)) {
            ?>
<div class="card col-md-5 tarjetas p-3 m-5" >
                    <img src="<?php echo $pro['proImagen'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pro['titulo']; ?></h5>
                        <p id="results"><?php 
                      $date_add = new DateTime($pro['fechaFin']);
                      $date_upd = new DateTime(date('Y-m-d H:i:s'));
                      $diff = $date_add->diff($date_upd);
                      echo 'Tiempo restante: ';
 
                            $time_elapsed = '';
                            
                            if ($diff->y > 0 && $diff->y != 1) {
                                $time_elapsed .= $diff->y.' años ';
                            }
                            
                            if ($diff->m > 0) {
                                $time_elapsed .= $diff->m.' meses ';
                            }
                            
                            if ($diff->days > 0 && $diff->days != 1) {
                                $time_elapsed .= $diff->days.' días ';
                            } else {
                                $time_elapsed .= $diff->days.' día ';
                            }
                            
                            if ($diff->h > 0 && $diff->h != 1) {
                                $time_elapsed .= $diff->h.' horas ';
                            } elseif ($diff->h == 1) {
                                $time_elapsed .= $diff->h.' hora ';
                            }
                            
                            if ($diff->i > 0  && $diff->i != 1) {
                                $time_elapsed .= $diff->i.' minutos ';
                            } elseif ($diff->i == 1) {
                                $time_elapsed .= $diff->i.' minuto ';
                            }
                            
                            if ($diff->s > 1 && $diff->i != 1) {
                                $time_elapsed .= ' '.$diff->s.' segundos.';
                            } else {
                                $time_elapsed .= $diff->s.' segundo.';
                            }
                            
                            echo $time_elapsed;
                                                    ?></p>
                        <p>Fecha de inicio <?php echo $pro['fechaIni']; ?></p>
                         <p>Precio Inicial<?php echo $pro['precioInicial']; ?></p>   
                        <p>Usuario que lo vende: <?php  
                        $vendedor=consultaUsuarioId($conexion,$pro['idUsuario']);
                        $vend=mysqli_fetch_assoc($vendedor);
                        echo $vend['usuario'];
                        ?></p>
                        <?php 
                        $puj=consultaMaximaPujaProductos($conexion,$pro['idProducto']);
                    
                        

                         ?>
                         <p>Ultima Puja:
                            <?php if (mysqli_num_rows($puj)==1) {
                          $PujaMax=mysqli_fetch_assoc($puj);
                        if($PujaMax['max(valor)']!="" || $PujaMax['max(valor)']!=null || $PujaMax['max(valor)']!=0){ echo $PujaMax['max(valor)']." Euros";}}else {
                           echo "Sin puja";
                         } ?></p>
                         <form action="mostrarProducto.php" method="POST">
                        <input type="hidden" name="produId" value="<?php echo $pro['idProducto']; ?>">
                        <input type="submit" class="btn btn-primary" value="Mostrar Informacion" name="mosInfo">
                        </form>
                    </div>
                </div>
            <?php
            
    
     
        }
        
       ?>

    </div> 
    </div>
<?php
if (isset($_POST['subirPro'])) {
   
  //Recogemos el archivo enviado por el formulario
  $archivo = $_FILES['archivo']['name'];
  //Si el archivo contiene algo y es diferente de vacio
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
  }
  $articulo=$_POST['articulo'];
  $precio=$_POST['precio'];
  $Descripcion=$_POST['Descripcion'];
  $dias=$_POST['dias'];
  $precioEnvio=$_POST['precioEnvio'];
  $fecha_actual = date("Y-m-d H:i:s");
  $fechaFin=date("Y-m-d H:i:s",strtotime($fecha_actual."+ $dias day"));
 
  $seccion=$_POST['seccion'];
  $ubiArchivo="images/$archivo";
  $ResulInserPro=insertarProducto($conexion,$_SESSION['idUsuario'],$fecha_actual,$fechaFin,$precio,$seccion,$ubiArchivo,$Descripcion,$articulo,$precioEnvio);
 if ($ResulInserPro) {
   ?>
   <div class="card col-12">
       <div class="card-header">
           Se subio correctamente
       </div>
       <div class="card-body">
       <img src="images/<?php echo $archivo; ?>">
           <h5 class="card-title">Se introdujo correctamente el producto <?php echo $articulo; ?></h5>
           <a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
       </div>
   </div>
   <?php 
 }
}

if (isset($_POST['comentar'])) {
  $fecha_actual = date("Y-m-d H:i:s");
  echo $_SESSION['idUsuario']."-".$_POST['contenido']."-".$_SESSION['produViendo']."-".$fecha_actual;
  $resulInserComentario=insertarComentario($conexion,$_SESSION['idUsuario'],$_POST['contenido'],$_SESSION['produViendo'],$fecha_actual);
if ($resulInserComentario) {
  ?>
  <div class="card">
      <div class="card-header">
          Se inserto correctamente
      </div>
      <div class="card-body">
          <a href="mostrarProducto.php" class="btn btn-primary">Volver al Productos</a>
      </div>
  </div>
  <?php 
}
}
?>
</div>
<?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>

</html>