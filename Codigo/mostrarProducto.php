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
    <link rel="stylesheet" href="css/style.css">
    <script src="ajax.js"></script>
    <?php include 'nav.php'; ?>
</head>
<body class="">






 <div class="container">
    
        <div class="row justify-content-center">
        
        </div>
        
        <div class="row justify-content-center">
       <?php
       if (isset($_POST['produId'])) {
        $_SESSION['produViendo']=$_POST['produId'];
       }
       if (isset($_SESSION['produViendo'])) {
           $productos=consultaProductoPorId($conexion,$_SESSION['produViendo']);
       
           $pro=mysqli_fetch_assoc($productos);
           ?>
           <div class="card col-md-12 tarjetas p-3 m-5" >
           <h1 class="card-title text-center"><?php echo $pro['titulo']; ?></h1>
                    <img src="<?php echo $pro['proImagen'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pro['titulo']; ?></h5>
                        <p>Descripción: <?php echo $pro['Descripcion']; ?></p>
                        <p>Seccion <?php echo $pro['nombreSec']; ?></p>
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
                        $puj=consultaMaximaPujaProductos($conexion,$_SESSION['produViendo']);
                        $PujaMax=mysqli_fetch_assoc($puj);
                         ?>
                         <p>Ultima Puja:
                            <?php if($PujaMax['max(valor)']!="" || $PujaMax['max(valor)']!=null || $PujaMax['max(valor)']!=0){ echo $PujaMax['max(valor)']." Euros";}else {
                           echo "Sin puja";
                         } ?></p>
                         <?php 
                         if (isset($_SESSION['usuario'])) {
                             
                         
                         ?>
                         
                         <form action="mostrarProducto.php" method="POST">
                             <label for="puja">Pujar</label>
                            <div class="form-group col-12">
                                <label for="dias">Pujar: <span id="demo"></label>
                            <input type="range" step ="0.25" min="<?php 
                                                        if($PujaMax['max(valor)']!="" || $PujaMax['max(valor)']!=null || $PujaMax['max(valor)']!=0){ 
                                                            echo round(($PujaMax['max(valor)']*1.001), 1, PHP_ROUND_HALF_DOWN);
                                                            }else {
                                                                echo round( ($pro['precioInicial']*1.001), 1, PHP_ROUND_HALF_DOWN);
                                                            } ?>"  max="<?php 
                                                        if($PujaMax['max(valor)']!="" || $PujaMax['max(valor)']!=null || $PujaMax['max(valor)']!=0){ 
                                                            echo (2*round(($PujaMax['max(valor)']*1.01), 1, PHP_ROUND_HALF_DOWN));
                                                            }else {
                                                                echo (2*round(($pro['precioInicial']*1.01), 1, PHP_ROUND_HALF_DOWN));
                                                            } ?>" value="<?php 
                                                        if($PujaMax['max(valor)']!="" || $PujaMax['max(valor)']!=null || $PujaMax['max(valor)']!=0){ 
                                                            echo round(($PujaMax['max(valor)']*1.001), 1, PHP_ROUND_HALF_DOWN);
                                                            }else {
                                                                echo round( ($pro['precioInicial']*1.001), 1, PHP_ROUND_HALF_DOWN);
                                                            } ?>" name="puja" id="myRange">
                            </div>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
                            
                        <input type="hidden" name="produId" value="<?php echo $pro['idProducto']; ?>">
                        <input type="hidden" name="usuarioId" value="<?php echo $pro['idUsuario']; ?>">
                        <input type="submit" class="btn btn-primary col-3" value="pujar" name="pujar">
                        </form>
                        <?php } ?>
                    </div>
                </div>
                <?php
                
       }
       if(isset($_POST['pujar'])){
            echo $_POST['puja']."-".$_POST['produId']."-".$_POST['usuarioId'];
            $fecha_actual = date("Y-m-d H:i:s");
            $resuInserPuja=insertarPuja($conexion,$_POST['usuarioId'],$_POST['produId'],$fecha_actual,$_POST['puja']);
            if ($resuInserPuja) {
                ?>
                <div class="card col-12">
                    <div class="card-header">
                       Enorabuena realizo una puja de <?php echo $_POST['puja']; ?>
                    </div>
                    <div class="card-body">
                        <a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
                    </div>
                </div>
                <?php 
            }else{
                ?>
                <div class="card col-12">
                    <div class="card-header">
                       Hubo un error con una puja de <?php echo $_POST['puja']; ?> Euros
                    </div>
                    <div class="card-body"><h5 class="card-title">Error al in
                        <a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
                    </div>
                </div>
                <?php 
            }
       }
       ?>

    </div> 
    
        
        <div class="card col-12" >
          <div class="row no-gutters">
            <div class="col-md-12 justify-content-center">
              <div class="card-body">
                
              
        <?php
    $com=consultaComentarioPorId($conexion,$_SESSION['produViendo']);
    while ($comentario=mysqli_fetch_assoc($com)) {
        ?>
<h5><?php echo $comentario['usuario']; ?></h5>
<p><?php echo $comentario['contenido']; ?></p>
        <?php
    }
    ?>
    </div>
            </div>
          </div>
          <div class="justify-content-end align-items-end ">
          <form action="principal.php" method="post">
              <input type="text" name="contenido">
              <input type="submit" value="Comentar" name="comentar">
          </form>
          </div>
        </div>
        
    </div> 
    <?php include 'footer.php'; ?>

<?php

?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>
</html>