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
<body style="background-color: rgba(203, 216, 252, 0.603);">



<div class="row">
    
          <h1 class="text-center col-12">Secciones</h1>
</div>


    <form action="secciones.php" method="POST">
        <div class="input-group col-12">
            <div class="input-group-prepend">
                <label class="input-group-text" for="seccion">Filtrar por secciones:</label>
            </div>
            <select class="custom-select" id="seccion" name="seccion">
                <option value="0" selected>Todos los productos</option>
                <?php
        $secc=consultaSeccion($conexion);
        While($secciones=mysqli_fetch_assoc($secc)){
      ?>
<option value="<?php echo $secciones['idSeccion']; ?>"><?php echo $secciones['idSeccion']."-".$secciones['nombreSec']; ?></option>
  
<?php
        }
?>
            </select>
            <div class="input-group-append">
            <input type="submit" value="Filtrar" class="btn btn-primary" name="filtrar">
            </div>
        </div>
    </form>

        <div class="row">
        <?php
                if (isset($_POST['filtrar']) || isset($_POST['filtrarSec'])) {
                    //Filtrar todos
                    if (isset($_POST['filtrarSec'])) {
                        $_POST['seccion']=1;                    }
                    if ($_POST['seccion']==0) {
                        $fecha=date('Y-m-d H:i:s');
        $productos=consultaProductosEnSubasta($conexion,$fecha);
       ?>
<h1 class="text-center col-12">Todos los productos</h1>
       <?php
        while ($pro=mysqli_fetch_assoc($productos)) {
            ?>
<div class="card col-md-3 tarjetas p-3 m-5" >
    <div style="height:250px;">
                    <img src="<?php echo $pro['proImagen'];?>" class="img-thumbnail card-img-top"  style="height:100%;">
                    </div>
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
                        <input type="submit" value="Mostrar Informacion" name="mosInfo">
                        </form>
                    </div>
                </div>
            <?php
            
    
     
        }
                    }else{//Segun seccion
                        ?>

                        <?php
                        $fecha=date('Y-m-d H:i:s');
                        $productos=consultaProductosEnSubastaPorSecciones($conexion,$fecha,$_POST['seccion']);
                        $sec=consultaSeccionPorId($conexion,$_POST['seccion']);
                        $section=mysqli_fetch_assoc($sec);
                        ?>
<h1 class="text-center col-12"><?php echo $section['nombreSec'] ?></h1>
                        <?php
                        while ($pro=mysqli_fetch_assoc($productos)) {
                                    ?>
                        <div class="card col-md-3" >
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
                                                <input type="submit" class="" value="Mostrar Informacion" name="mosInfo">
                                                </form>
                                            </div>
                                        </div>
                                      
                                    <?php
                                    
                            
                             
                                }
                    }
                }else{//En el caso de que se carge la pagina ,para que se mantengan todos
                    echo "c";
                }
            ?>
            </div>
           
            
            <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>
</html>