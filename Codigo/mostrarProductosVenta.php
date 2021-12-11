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
    <link rel="stylesheet" href="css/style.css">
    <?php include 'nav.php'; ?>
</head>

<body>
    <form action="mostrarProductosVenta.php" method="post">
        <select name="produ" value="0">
            <option value="0">Todos los producto</option>
            <option value="1">Aun en venta</option>
            <option value="2">Ya vendidos y fuera de tiempo</option>
        </select>
        <input type="submit" value="Buscar" name="busc">
    </form>
<?php
$resul=consultaProductoPorIdUsuario($conexion,$_SESSION['idUsuario']);
if (mysqli_num_rows($resul)>=1) {
    if ($_POST['produ']==1 && isset($_POST['busc'])) {
        
    
    ?>
<h1 class="text-center col-12">Productos en Venta</h1>
    <?php
    while ($resulEnVenta=mysqli_fetch_assoc($resul)) {
    $fechaA = date("Y-m-d H:i:s");
    $fechaIni=$resulEnVenta['fechaIni'];
    $fechaFin=$resulEnVenta['fechaFin'];
    //$restriccionH=date("Y-m-d H:i:s",strtotime($produElim['fechaFin']."- $HorasRestric Hour"));
    if ($fechaA>$fechaIni && $fechaA<$fechaFin) {
        $puj=consultaMaximaPujaProductos($conexion,$resulEnVenta['idProducto']);
        $ultPuja=mysqli_fetch_assoc($puj);
    
        ?>
        
        <div class="card mb-12" >
          <div class="row no-gutters">
            <div class="col-md-5">
              <img src="<?php echo $resulEnVenta['proImagen'] ?>">
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h5 class="card-title"><?php echo $resulEnVenta['titulo']; ?></h5>
                <p class="card-title"><b>Descripcion</b> <?php echo $resulEnVenta['Descripcion']; ?></p>
                <p class="card-text"><b>Valor Ultima puja:</b> <?php if ($ultPuja['max(valor)']==0 || $ultPuja['max(valor)']==null) {
                    echo "Sin puja aun";
                }else {
                    echo $ultPuja['max(valor)']." Euros";
                }  ?> Euros</p>
                
              </div>
            </div>
          </div>
        </div>
        
        <?php
         }
    }
}elseif ($_POST['produ']==0 || $_POST['produ']==null && isset($_POST['busc'])) {
    $_POST['produ']=0;
    ?>
<h1 class="text-center">Todos sus productos en Venta</h1>
    <?php
    while ($resulEnVenta=mysqli_fetch_assoc($resul)) {
        $fechaA = date("Y-m-d H:i:s");
        $fechaIni=$resulEnVenta['fechaIni'];
        $fechaFin=$resulEnVenta['fechaFin'];
        //$restriccionH=date("Y-m-d H:i:s",strtotime($produElim['fechaFin']."- $HorasRestric Hour"));
            $puj=consultaMaximaPujaProductos($conexion,$resulEnVenta['idProducto']);
            $ultPuja=mysqli_fetch_assoc($puj);
        
            ?>
            
            <div class="card mb-12" >
              <div class="row no-gutters">
                <div class="col-md-5 mt-3">
                  <img src="<?php echo $resulEnVenta['proImagen'] ?>">
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $resulEnVenta['titulo']; ?></h5>
                    <p class="card-title"><b>Descripcion</b> <?php echo $resulEnVenta['Descripcion']; ?></p>
                    <p class="card-text"><b>Valor Ultima puja:</b> <?php if ($ultPuja['max(valor)']==0 || $ultPuja['max(valor)']==null) {
                    echo "Sin puja aun";
                }else {
                    echo $ultPuja['max(valor)']." Euros";
                }  ?></p>
                    <p class="card-text"><b>Estado:</b><?php 
                        if ($fechaA>$fechaIni && $fechaA<$fechaFin) {
                            echo "Aun en venta";
                        }elseif ($fechaA>$fechaFin) {
                            if ($ultPuja['max(valor)']==0 || $ultPuja['max(valor)']==null) {
                                echo "No se pujo por el, vuelva a subir el producto, para volver a intentarlo";
                            }else{
                                echo "Se vendió por ".$ultPuja['max(valor)']."Euros";
                            }
                        }
                    ?></p>
                    
                  </div>
                </div>
              </div>
            </div>
            
            <?php
             
        }
}elseif ($_POST['produ']==2 && isset($_POST['busc'])) {
    ?>
<h1 class="text-center col-12">Productos ya vendidos o fuera de fecha</h1>
    <?php
    while ($resulEnVenta=mysqli_fetch_assoc($resul)) {
        $fechaA = date("Y-m-d H:i:s");
        $fechaIni=$resulEnVenta['fechaIni'];
        $fechaFin=$resulEnVenta['fechaFin'];
        //$restriccionH=date("Y-m-d H:i:s",strtotime($produElim['fechaFin']."- $HorasRestric Hour"));
            $puj=consultaMaximaPujaProductos($conexion,$resulEnVenta['idProducto']);
            $ultPuja=mysqli_fetch_assoc($puj);
            if ($fechaA>$fechaFin) {
                $puj=consultaMaximaPujaProductos($conexion,$resulEnVenta['idProducto']);
                $ultPuja=mysqli_fetch_assoc($puj);
            
            ?>
            
            <div class="card mb-12" >
              <div class="row no-gutters">
                <div class="col-md-5 mt-3">
                  <img src="<?php echo $resulEnVenta['proImagen'] ?>">
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $resulEnVenta['titulo']; ?></h5>
                    <p class="card-title"><b>Descripcion</b> <?php echo $resulEnVenta['Descripcion']; ?></p>
                    <p class="card-text"><b>Valor Ultima puja:</b> <?php if ($ultPuja['max(valor)']==0 || $ultPuja['max(valor)']==null) {
                    echo "Sin puja aun";
                }else {
                    echo $ultPuja['max(valor)']." Euros";
                }  ?></p>
                    <p class="card-text"><b>Estado:</b><?php 
                        if ($fechaA>$fechaIni && $fechaA<$fechaFin) {
                            echo "Aun en venta";
                        }elseif ($fechaA>$fechaFin) {
                            if ($ultPuja['max(valor)']==0 || $ultPuja['max(valor)']==null) {
                                echo "No se pujo por el, vuelva a subir el producto, para volver a intentarlo";
                            }else{
                                echo "Se vendió por ".$ultPuja['max(valor)']."Euros";
                            }
                        }
                    ?></p>
                    
                  </div>
                </div>
              </div>
            </div>
            
            <?php
            }
        }
}
}else{
    ?>
            <div class="card">
                <div class="card-header">
                Aun no tiene productos a la venta
                </div>
                <div class="card-body">
                    
                    <a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
                </div>
            </div>
            <?php 
}
 ?>
 <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>