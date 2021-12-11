
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="css/style.css">
    <?php include 'nav.php';
            require 'BD/ConectorBD.PHP';
            require 'BD/DAOUsuario.PHP'; 
            $conexion=conectar(false); ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body style="background-color: rgba(203, 216, 252, 0.603);">
    <div class="row justify-content-center col-10 rounded"  style="margin:0 auto; background-color: rgba(255, 99, 71, 0.678); padding-top: 20px;">
    <div class="col-12 text-center"><h1 class="text-center col-12">Login</h1></div>
    <form method="POST" action="comprobarUsuario.php" id="login">
    <div>
      <label for="usuario">Usuario <i class="fas fa-user"></i></label>
      <input type="text" class="form-control" id="usuario" placeholder="First name" name="usuario">
             <small id="avisoUsuario"></small>
  </div>
    
        <div class="form-group">
            <label for="password">contraseña <i class="fas fa-lock"></i></label>
            <input type="password" name="password" class="form-control" placeholder="Enter User" id="pass">
             <small id="mMostrar">Mostrar </small><input type="checkbox" onclick="myFunction()">
             <small id="avisoPass"></small>
        </div>
        <small id="avisoFormulario"></small>
        <input type="submit" value="Login" class="btn col-12 bg-info" id="login">
        <a href="" class="d-block">¿Olvido su contraseña?</a>
        <a href="" class="d-block">Ingresar Usuario</a>
    </form>

    </div>
    <?php
    if (isset($_POST['cambiarPass'])) {
        echo $_SESSION['idUsuario']."".$_POST['contra'];
        $resulModificarContra=modificar($conexion,$_SESSION['idUsuario'],"password",$_POST['contra']);
        if ($resulModificarContra) {
            ?>
    <div class="card col-12">
        <div class="card-header">
            se modifico Correctamente
        </div>
        <div class="card-body">
        <a href="recuperar_pass.php" class="btn btn-primary">Volver a Login</a>
        </div>
    </div>
    <?php
        }
    
}else{
    echo "c";
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
    <script src="js/validacionLogin.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>