
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
         
        $conexion=conectar(false)
    ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php

        
    ?>
    <div class="row d-flex justify-content-center vh-75" >
    <form style="margin:0 auto; background-color: rgba(255, 99, 71, 0.678); padding-top: 20px;" class="col-8 rounded" id="alta" action="ingreso.php" method="POST">
        <h1 class="text-center">Ingreso</h1>
        <div class="form-group col-xs-12">
            <label for="usuario">Usuario <i class="fas fa-user"></i></label>
            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Enter User"> 
            <small id="avisoUsuario"></small>
        </div>
        <div class="form-group col-xs-12">
            <label for="password">contraseña <i class="fas fa-lock"></i></label>
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter password">
            <small id="avisoPass"></small>
        </div>
        <div class="form-group col-xs-12">
            <label for="password1">Vuelva a escribir la contraseña <i class="fas fa-lock"></i></label>
            <input type="password" id="pass1" name="password1" class="form-control" placeholder="Enter password">
            <small id="avisoPass1"></small>
        </div>
        <div class="form-group col-xs-12">
            <label for="nombre">Nombre<i class="fas fa-user-tag"></i></label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="ej ->Alberto">
            <small id="avisoNombre"></small>
        </div>
        <div class="form-group col-xs-12">
            <label for="email">email<i class="fas fa-user-tag"></i></label>
            <input type="text" id="email" name="email" class="form-control" placeholder="ej ->Alberto">
            <small id="avisoEmail"></small>
        </div>
        <div class="form-group col-xs-12">
            <label for="apellidos">Apellidos<i class="fas fa-user-tag"></i></label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="ej ->Hernandez">
            <small id="avisoApellidos"></small>
        </div>
        <div class="form-group col-xs-12">
            <label for="Telefono">Telefono<i class="fas fa-user-tag"></i></label>
            <input type="text" id="telefono" name="Telefono" class="form-control" placeholder="ej ->Hernandez">
            <small id=avisoTel></small>
        </div>
        <div class="form-group col-xs-12">
            <label for="dni">DNI <i class="fas fa-id-card"></i></label>
            <input type="text" id="dni" name="dni" class="form-control" placeholder="ej ->Alberto">
            <small id="avisoDNI"></small>
        </div>
        <div class="form-group col-xs-12">
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
                                  <small id="avisoComunidad"></small>
                              </div>
        </div>
        <div class="form-group col-xs-12">
            <label for="direccion">Direccion <i class="fas fa-id-card"></i></label>
            <input type="text" id="direccion" name="direccion" class="form-control" placeholder="C/ Casanova, 8">
            <small id="avisoDirec"></small>
            <small id="avisoForm"></small>
        </div>
        <a href="" class="d-block">Volver a Login</a>
        <input type="submit" value="Enviar" name="ingreso" id="formulario">
    </form>
 
    </div>
    <?php
        if (isset($_POST['ingreso'])) {
            echo $_POST['usuario']."-".$_POST['pass']."-".$_POST['password1']."-".$_POST['nombre']."-".$_POST['email']."-".$_POST['apellidos']."-".$_POST['Telefono']."-".$_POST['dni']."-".$_POST['comunidad']."-".$_POST['provincia']."-".$_POST['cp']."-".$_POST['direccion'];
            $resulInserUsu=insertarUsuarioComple($conexion,$_POST['usuario'], $_POST['pass'], $_POST['nombre'], $_POST['apellidos'], $_POST['dni'], $_POST['comunidad'], $_POST['provincia'], $_POST['cp'], $_POST['direccion'], "usuario", $_POST['Telefono'], $_POST['email']);
            if ($resulInserUsu) {
                ?>
                <div class="card">
                    <div class="card-header">
                    Se le dio correctamente de alta <?php $_POST['nombre']; ?>.
                    </div>
                    <div class="card-body">
                        <a href="login.php" class="btn btn-primary">Loguearse</a>
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
    <script src="js/validacionLogin.js"></script>
    <script src="js/script.js"></script>
</body>
</html>