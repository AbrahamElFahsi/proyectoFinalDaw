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
<body style="height: inherit; min-height: 100%; width: 100%;>
<?php
$resulCarr=todasLasPujasDeUsuario($conexion,$_SESSION['idUsuario']);
if (mysqli_num_rows($resulCarr)>=1) {
    while ($respuj=mysqli_fetch_assoc($resulCarr)) {
        $resMaxPuj=consultaMaximaPujaProductos($conexion,$respuj['idProducto']);
        $resMaxPujProdu=mysqli_fetch_assoc($resMaxPuj);
        if ($resMaxPujProdu['idUsuario']==$_SESSION['idUsuario'] && $resMaxPujProdu['max(valor)']==$respuj['valor']) {
          $fecha_actual = date("Y-m-d H:i:s");
          if ($fecha_actual>$respuj['fechaFin']) {
            
          
            ?>
        
        <div class="card mb-12" >
          <div class="row no-gutters">
            
              <img class="col-md-4"  src="<?php echo $respuj['proImagen'] ?>">
            
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?php echo $respuj['titulo']; ?></h5>
                <p class="card-title"><b>Descripcion</b> <?php echo $respuj['Descripcion']; ?></p>
                <p class="card-text"><b>Precio a pagar:</b> <?php
                    echo $resMaxPujProdu['max(valor)']." Euros";
                 ?></p>
                <form action="mostrarProductosComprar.php" method="post">
                    <input type="hidden" name="precio" value="<?php echo $resMaxPujProdu['max(valor)']; ?>">
                    <input type="hidden" name="Nombre" value="<?php echo $respuj['titulo']; ?>">
                    <input type="hidden" name="Descripcion" value="<?php echo $respuj['Descripcion'];; ?>">
                    <input type="hidden" name="idProducto" value="<?php echo $respuj['idProducto']; ?>">
                    <input type="submit" value="Tamitar pago" name="pagar">
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <?php
        }
        }
    }
}else{
    echo "Lo siento no a pujado por ningun producto";
}
if (isset($_POST['pagar'])) {
    ?>
        
    <div class="card mb-12" >
      <div class="row no-gutters">
        <div class="col-md-4">
        
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?php echo $_POST['Nombre']; ?></h5>
            <p class="card-title"><b>Descripcion</b> <?php echo $_POST['Descripcion']; ?></p>
            <p class="card-text"><b>Precio a pagar:</b> <?php
                echo $_POST['precio']." Euros";
             ?></p>
       <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="CORREO AL QUE SE LE PAGA">
    <input type="hidden" name="currency_code" value="EUR">
    <input type="hidden" name="item_name" value="<?php echo $_POST['Nombre'] ?>">
    <input type="hidden" name="amount" value="<?php echo $_POST['precio'] ?>">
    <input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
          </div>
        </div>
      </div>
    </div>
    
    <?php
}
?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <?php include 'footer.php'; ?>
</body>

</html>