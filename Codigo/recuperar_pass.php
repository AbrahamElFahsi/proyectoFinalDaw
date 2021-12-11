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
    <?php 
        include 'nav.php';
        require 'BD/ConectorBD.PHP';
        require 'BD/DAOUsuario.PHP'; 
         
        $conexion=conectar(false);
    ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="row justify-content-center col-10 rounded"  style="margin:0 auto; background-color: rgba(255, 99, 71, 0.678); padding-top: 20px;">
    <div class="col-12 text-center"><h1>Recuperar contraseña</h1></div>
    <form method="POST" action="recuperar_pass.php" id="login">
        <div>
            <label for="email">Introduzca su correo electrónico: <i class="fas fa-user"></i></label>
            <input type="text" class="form-control" id="email" placeholder="First name" name="email">
            <small id="avisoUsuario">termine de escribir su correo <?php echo substr($_SESSION['email'], 0, 2); ?>*******</small>
        </div>
        <small id="avisoFormulario"></small>
        <input type="submit" value="Enviar valores" class="btn col-12 bg-info" name="recuperarContra">
        <a href="recuperar_pass.php" class="d-block">¿Olvido su contraseña?</a>
        <a href="" class="d-block">Ingresar Usuario</a>
    </form>

    </div>
    <?php
if (isset($_POST['recuperarContra']) && $_SESSION['email']==$_POST['email']) {
    ?>
    <div class="card col-12">
        <div class="card-header">
            Cambiar contraseña
        </div>
        <div class="card-body">
        <form action="login.php" method="post">
        <div>
            <label for="email">Introduzca su nueva contraseña: <i class="fas fa-user"></i></label>
            <input type="text" class="form-control" id="contra" placeholder="First name" name="contra">
            <input type="submit" value="Cambiar" class="btn col-12 bg-info" name="cambiarPass">
        </div>
        </form>
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