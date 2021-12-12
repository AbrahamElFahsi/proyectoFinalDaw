<?php
require 'BD/ConectorBD.PHP';

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
   
    <link rel="stylesheet" href="css/style.css">
    <?php include 'nav.php'; ?>
</head>

<body>

 <?php
if (isset($_SESSION['usuario'])) {
    //logueado
    if($_SESSION['Rol']=="admin"){

    }else {
        
    }
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 ">
            <h1 class="padding-5 rounded-circle text-center">Principal</h1>
            <ul>
                <li>
                    <p class="text-center"><a href="principal.php"> pagina principal</a></p>
                </li>
            </ul>
        </div>

    </div>
</div>
<?php
}
 ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>