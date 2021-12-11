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
<?php
if (isset($_POST['modi'])) {
$idUsuMody=$_POST['usuMody'];
echo $idUsuMody;
$usuModify=consultaUsuarioId($conexion,$idUsuMody);
$usMo=mysqli_fetch_assoc($usuModify);
$_SESSION['usuarioAModificar']=$idUsuMody;
 } 
 ?>
<body>
<form action="modificarUsuario.php" method="post" class="row">
        <div class="form-group col-4">
            <label for="usuario">Usuario <i class="fas fa-user"></i></label>
            <?php
            if (isset($_POST['modi'])) {
                ?>
            <small>Su usuario es: <b><?php echo $usMo['usuario']; ?></b></small>
<?php
}else{
    ?>
        <small>Su usuario es: <b><?php echo $_SESSION['usuario']; ?></b></small>
    <?php
}
?>
            <input type="text" name="usuario" class="form-control" placeholder="Enter User"> 
        </div>
        <div class="form-group col-4">
            <label for="password">contraseña <i class="fas fa-lock"></i></label>
                <?php
                if (isset($_POST['modi'])) {
                    ?>
            <small>¿Desea cabiar la contraseña?: <b><?php echo substr($usMo['password'],0,1); ?>*****</b></small>
                <?php
                    }else{
                        ?>
                            <small>Su usuario es: <b><?php echo substr($_SESSION['password'],0,1); ?></b></small>
                        <?php
                    }
                    ?>
                    
            <input type="password" name="password" class="form-control" placeholder="Enter password">
        </div>
        <div class="form-group col-4">
            <label for="password1">Vuelva a escribir la contraseña <i class="fas fa-lock"></i></label>
            <input type="password" name="password1" class="form-control" placeholder="Enter password">
        </div>
        <div class="form-group col-4">
            <label for="email">email <i class="fas fa-user"></i></label>
            <?php
            //email
            if (isset($_POST['modi'])) {
                ?>
            <small>Su email es: <b><?php echo $usMo['email']; ?></b></small>
<?php
}else{
    ?>
        <small>Su email es: <b><?php echo $_SESSION['email']; ?></b></small>
    <?php
}
?>
            <input type="text" name="email" class="form-control" placeholder="Enter User"> 
        </div>
        <div class="form-group col-4">
            <label for="telefono">telefono <i class="fas fa-user"></i></label>
            <?php
            //telefono
            if (isset($_POST['modi'])) {
                ?>
            <small>Su telefono es: <b><?php echo $usMo['telefono']; ?></b></small>
<?php
}else{
    ?>
        <small>Su telefono es: <b><?php echo $_SESSION['telefono']; ?></b></small>
    <?php
}
?>
            <input type="text" name="telefono" class="form-control" placeholder="Enter User"> 
        </div>
        <div class="form-group col-4">
            <label for="nombre">Nombre<i class="fas fa-user-tag"></i></label>
                <?php
                if (isset($_POST['modi'])) {
                    ?>
            <small>Su nombre es: <b><?php echo $usMo['nombre']; ?></b></small>
                <?php
                    }else{
                        ?>
                            <small>Su usuario es: <b><?php echo $_SESSION['usuario']; ?></b></small>
                        <?php
                    }
                    ?>
            <input type="text" name="nombre" class="form-control" placeholder="ej ->Alberto">
        </div>
        <div class="form-group col-4">
            <label for="apellidos">Apellidos<i class="fas fa-user-tag"></i></label>
                <?php
                if (isset($_POST['modi'])) {
                    ?>
            <small>Su apellidos es: <b><?php echo $usMo['apellidos']; ?></b></small>
                <?php
                    
                }else{
                    ?>
                        <small>Su apellidos es: <b><?php echo $_SESSION['apellidos']; ?></b></small>
                    <?php
                }
                    ?>
            <input type="text" name="apellidos" class="form-control" placeholder="ej ->Hernandez">
        </div>
        <div class="form-group col-4">
            <label for="dni">DNI <i class="fas fa-id-card"></i></label>
                <?php
                if (isset($_POST['modi'])) {
                    ?>
            <small>Su dni es: <b><?php echo $usMo['dni']; ?></b></small>
                <?php
                    }else{
                        ?>
                            <small>Su dni es: <b><?php echo $_SESSION['dni']; ?></b></small>
                        <?php
                    }
                    ?>
            <input type="text" name="dni" class="form-control" placeholder="ej ->Alberto">
        </div>
        <div class="form-group col-4">
                                    <?php
                                    if (isset($_POST['modi'])) {
                                        ?>
                                <small>Su Comunidad es: <b><?php echo $usMo['comunidad']; ?></b> Su provincia es: <b><?php echo $usMo['provincia']; ?></b> y Su cp es: <b><?php echo $usMo['cp']; ?></b></small>
                                    <?php
                                        }else{
                                            ?>
                                                <small>Su Comunidad es: <b><?php echo $_SESSION['comunidad']; ?></b> Su provincia es: <b><?php echo $_SESSION['provincia']; ?></b> y Su cp es: <b><?php echo $_SESSION['cp']; ?></b></small>
                                            <?php
                                        }
                                        ?>
                                <div class="form-group col-6">
        <div class="control_label">
                                <label for="vacante">Comunidad</label>
                              </div>
                              <div class="control_input">
                                <select name="comunidad" id="comunidad">
                                    <option value="0">Seleccione una opción</option>
                                    <option value="andalucia">Andalucia</option>
                                    <option value="Aragón">Aragón</option>
                                    <option value="Asturias">Asturias</option>
                                    <option value="Baleares">Baleares</option>
                                    <option value="Cantabria">Cantabria</option>
                                    <option value="PaísVasco">PaísVasco</option>
                                    <option value="CastillayLeón">CastillayLeón</option>
                                    <option value="cataluña">cataluña</option>
                                    <option value="CValenciana">C.Valenciana</option>
                                    <option value="Galicia">Galicia</option>
                                    <option value="Madrid">Madrid</option>
                                    <option value="Navarra">Navarra</option>
                                    <option value="Rioja">Rioja</option>
                                    <option value="Extremadura">Extremadura</option>
                                    <option value="Ceuta">Ceuta</option>
                                    <option value="Madrid">Melilla</option>
                                    
                                  </select>
                                </div>
                                <div class="control_label box--oculto">
                                  <label for="provincia">Provincia</label>
                                </div>
                                <div class="control_input box--oculto">
                                  <select name="provincia" id="provincia">
                                  </select>
                              </div>
                              <div class="control_label box--oculto">
                                  <label for="provincia">Codigo Postal</label>
                                </div>
                              <div class="control_input box--oculto">
                                  <select name="cp" id="cp">
                                  </select>
                              </div>
        </div>
                            </div>
        <div class="form-group col-4">
            <label for="direccion">Direccion <i class="fas fa-id-card"></i></label>
                <?php
                    if (isset($_POST['modi'])) {
                        ?>
            <small>Su dirección es: <b><?php echo $usMo['direccion']; ?></b></small>
                <?php
                    }else{
                        ?>
                            <small>Su dirección es: <b><?php echo $_SESSION['direccion']; ?></b></small>
                        <?php
                    }
                    ?>
            <input type="text" name="direccion" class="form-control" placeholder="C/ Casanova, 8">
        </div>
<?php
if ($_SESSION['Rol']=="admin") {
     ?>
        <div class="form-group col-4">
            <label for="rol">Rol <i class="fas fa-id-card"></i></label>
            <small>Su Rol es: <b><?php echo $usMo['Rol']; ?></b></small>
            <div>
            <select name="rol">
                <option value="0">Seleccione una Opcion</option>
                <option value="usu">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            </div>
        </div>
<?php
}
?>
        <div class="form-group col-4">
        <input type="submit" value="Modificar Usuario" name="modificar">
        </div>
</form>
<?php


//Primero comprobamos que se envio el formulario
if (isset($_POST['modificar'])) {
    if ($_SESSION['Rol']=="admin") {
        
    if ($_POST['nombre']!="" && $_POST['nombre']!=null) {
        echo $_SESSION['usuarioAModificar'];
        echo $_POST['nombre'];
        $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"nombre",$_POST['nombre']);
        if ($resulNOM) {  
?>
<div class="card">
  <div class="card-header">
    Modificación
  </div>
  <div class="card-body">
    <p class="card-text">Se modifico Corectamente el nombre a <?php echo $_POST['nombre']; ?></p>
        <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
    </div>
</div>
<?php
    }
}
//email
if ($_POST['email']!="" && $_POST['email']!=null) {
    echo $_SESSION['usuarioAModificar'];
    echo $_POST['email'];
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"email",$_POST['email']);
    if ($resulNOM) {  
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el email a <?php echo $_POST['email']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
//telefono
if ($_POST['telefono']!="" && $_POST['telefono']!=null) {
    echo $_SESSION['usuarioAModificar'];
    echo $_POST['telefono'];
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"telefono",$_POST['telefono']);
    if ($resulNOM) {  
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el telefono a <?php echo $_POST['telefono']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['usuario']!="" && $_POST['usuario']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"usuario",$_POST['usuario']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el usuario a <?php echo $_POST['usuario']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['apellidos']!="" && $_POST['apellidos']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"apellidos",$_POST['apellidos']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el apellidos a <?php echo $_POST['apellidos']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['dni']!="" && $_POST['dni']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"dni",$_POST['dni']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el dni a <?php echo $_POST['dni']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['password']!="" && $_POST['password']!=null) {
    echo $_SESSION['usuarioAModificar'];
    echo $_POST['usuario'];
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"password",$_POST['password']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el password a <?php echo $_POST['password']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['comunidad']!="0" && $_POST['comunidad']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"comunidad",$_POST['comunidad']);
    $resulNOMP=modificar($conexion,$_SESSION['usuarioAModificar'],"provincia",$_POST['provincia']);
    $resulNOMCP=modificar($conexion,$_SESSION['usuarioAModificar'],"cp",$_POST['cp']);
    if ($resulNOM && $resulNOMP && $resulNOMCP) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el comunidad a <?php echo $_POST['comunidad']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['direccion']!="" && $_POST['direccion']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"direccion",$_POST['direccion']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el direccion a <?php echo $_POST['direccion']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['rol']!="0" && $_POST['rol']!=null) {
    echo $_SESSION['usuarioAModificar'];
    echo $_POST['rol'];
    $resulNOM=modificar($conexion,$_SESSION['usuarioAModificar'],"Rol",$_POST['rol']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el Rol a <?php echo $_POST['rol']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
}
else {
    //si el uduario no es admin
    if ($_POST['nombre']!="" && $_POST['nombre']!=null) {
        $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"nombre",$_POST['nombre']);
        if ($resulNOM) {  
?>
<div class="card">
  <div class="card-header">
    Modificación
  </div>
  <div class="card-body">
    <p class="card-text">Se modifico Corectamente el nombre a <?php echo $_POST['nombre']; ?></p>
    <a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
    </div>
</div>
<?php
    }
}
if ($_POST['usuario']!="" && $_POST['usuario']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"usuario",$_POST['usuario']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el usuario a <?php echo $_POST['usuario']; ?></p>
<a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
</div>
</div>
<?php
}
}
if ($_POST['apellidos']!="" && $_POST['apellidos']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"apellidos",$_POST['apellidos']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el apellidos a <?php echo $_POST['apellidos']; ?></p>
<a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
</div>
</div>
<?php
}
}
if ($_POST['dni']!="" && $_POST['dni']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"dni",$_POST['dni']);
    if ($resulNOM) {
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el dni a <?php echo $_POST['dni']; ?></p>
<a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
</div>
</div>
<?php
}
}
if ($_POST['password']!="" && $_POST['password']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"password",$_POST['password']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el password a <?php echo $_POST['password']; ?></p>
<a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
</div>
</div>
<?php
}
}
if ($_POST['comunidad']!="0" && $_POST['comunidad']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"comunidad",$_POST['comunidad']);
    $resulNOMP=modificar($conexion,$_SESSION['idUsuario'],"provincia",$_POST['provincia']);
    $resulNOMCP=modificar($conexion,$_SESSION['idUsuario'],"cp",$_POST['cp']);
    if ($resulNOM && $resulNOMP && $resulNOMCP) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el comunidad a <?php echo $_POST['comunidad']; ?></p>
<a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
</div>
</div>
<?php
}
}
//email
if ($_POST['email']!="" && $_POST['email']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"email",$_POST['email']);
    if ($resulNOM) {  
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el email a <?php echo $_POST['email']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
//telefono
if ($_POST['telefono']!="" && $_POST['telefono']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"telefono",$_POST['telefono']);
    if ($resulNOM) {  
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el telefono a <?php echo $_POST['telefono']; ?></p>
    <a href="adminUsuario.php" class="btn btn-primary">Volver al panel de Usuario</a>    
</div>
</div>
<?php
}
}
if ($_POST['direccion']!="" && $_POST['direccion']!=null) {
    $resulNOM=modificar($conexion,$_SESSION['idUsuario'],"direccion",$_POST['direccion']);
    if ($resulNOM) {
        
    
?>
<div class="card">
<div class="card-header">
Modificación
</div>
<div class="card-body">
<p class="card-text">Se modifico Corectamente el direccion a <?php echo $_POST['direccion']; ?></p>
<a href="principal.php" class="btn btn-primary">Volver a la pagina principal</a>
</div>
</div>
<?php
}
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