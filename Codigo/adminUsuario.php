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
    <script src="ajax.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <?php include 'nav.php'; ?>
</head>
<body style="background-color: rgba(203, 216, 252, 0.603);">
<div class="col-12 text-center"><h1 class="text-center col-12">Panel de Administracion de usuario</h1></div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Listar Usuarios
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
  <div class="col-12 text-center"><h1>Listar usuarios</h1></div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">usuario</th>
      <th scope="col">nombre</th>
      <th scope="col">apellidos</th>
      <th scope="col">dni</th>
      <th scope="col">comunidad</th>
      <th scope="col">provincia</th>
      <th scope="col">cp</th>
      <th scope="col">direccion</th>
      <th scope="col">Rol</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $usuarios=todosUsuarios($conexion);
        While($usu=mysqli_fetch_assoc($usuarios)){
      ?>
    <tr>
      <th scope="row"><?php echo $usu['idUsuario']; ?></th>
      <td><?php echo $usu['usuario']; ?></td>
      <td><?php echo $usu['nombre']; ?></td>
      <td><?php echo $usu['apellidos']; ?></td>
      <td><?php echo $usu['dni']; ?></td>
      <td><?php echo $usu['comunidad']; ?></td>
      <td><?php echo $usu['provincia']; ?></td>
      <td><?php echo $usu['cp']; ?></td>
      <td><?php echo $usu['direccion']; ?></td>
      <td><?php echo $usu['Rol']; ?></td>
    </tr>
    <?php
        }
      ?>
  </tbody>
</table>
  </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Crear Usuario
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
  <div class="col-12 text-center"><h1 class="text-center col-12">Crear usuarios</h1></div>
    <form class="row" action="admin.php" method="POST" name="formulario">
        <div class="form-group col-6">
            <label for="usuario">Usuario <i class="fas fa-user"></i></label>
            <input type="text" maxlength="45" id="usuario" name="usuario" class="form-control" placeholder="Enter User"> 
        </div>
        <div class="form-group col-6">
            <label for="password">contraseña <i class="fas fa-lock"></i></label>
            <input type="password" maxlength="50" name="password" class="form-control" placeholder="Enter password">
        </div>
        <div class="form-group col-6">
            <label for="password1">Vuelva a escribir la contraseña <i class="fas fa-lock"></i></label>
            <input type="password" name="password1" class="form-control" placeholder="Enter password">
        </div>
        <div class="form-group col-6">
            <label for="nombre">Nombre<i class="fas fa-user-tag"></i></label>
            <input type="text" maxlength="45" name="nombre" class="form-control" placeholder="ej ->Alberto">
        </div>
        <div class="form-group col-6">
            <label for="apellidos">Apellidos<i class="fas fa-user-tag"></i></label>
            <input type="text" maxlength="50" name="apellidos" class="form-control" placeholder="ej ->Hernandez">
        </div>
        <div class="form-group col-6">
            <label for="dni">DNI <i class="fas fa-id-card"></i></label>
            <input type="text" maxlength="9" name="dni" class="form-control" placeholder="ej ->Alberto">
        </div>
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
        
        <div class="form-group col-6">
            <label for="Telefono">Telefono<i class="fas fa-user-tag"></i></label>
            <input type="text" maxlength="9" id="telefono" name="Telefono" class="form-control" placeholder="ej ->Hernandez">
            <small id=avisoTel></small>
        </div>
        <div class="form-group col-6">
            <label for="direccion">Direccion <i class="fas fa-id-card"></i></label>
            <input type="text" maxlength="70" name="direccion" class="form-control" placeholder="C/ Casanova, 8">
        </div>
        <div class="form-group col-6">
            <label for="email">email<i class="fas fa-user-tag"></i></label>
            <input type="text" maxlength="70" id="email" name="email" class="form-control" placeholder="ej ->Alberto">
            <small id="avisoEmail"></small>
        </div>
        <div class="form-group col-6">
            <label for="dni">Rol <i class="fas fa-id-card"></i></label>
            <select name="rol">
                <option value="0">Seleccione una Opcion</option>
                <option value="usu">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        <div class="col-6"><input name="crear" type="submit" value="Enviar"></div>
    </form>
    
    </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Modificar Usuario
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
<div class="col-12 text-center"><h1>Modificar usuarios</h1></div>
  <form action="modificarUsuario.php" class="col-12" method="POST">
  <select class="col-8" name="usuMody" id="usuMody">
  <option value="0">Identificador-Usuario</option>
  <?php
        $usuario=todosUsuarios($conexion);
        While($usM=mysqli_fetch_assoc($usuario)){
      ?>
<option value="<?php echo $usM['idUsuario']; ?>"><?php echo $usM['idUsuario']; ?>-<?php echo $usM['nombre']; ?></option>
<?php
        }
?>
</select>
<input type="submit" class="col-2" value="Modificar Usuario" name="modi">
</form>
  
  </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Eliminar Usuarios
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
    <div class="col-12 text-center"><h1>Eliminar usuarios</h1></div>
  <form action="eliminarUsuario.php" method="POST">
  <select name="usuElimi" id="usuElimi">
  <option value="0">Identificador-Usuario</option>
  <?php
        $usuario=todosUsuarios($conexion);
        While($usM=mysqli_fetch_assoc($usuario)){
      ?>
<option value="<?php echo $usM['idUsuario']; ?>"><?php echo $usM['idUsuario']; ?>-<?php echo $usM['nombre']; ?></option>
  


<?php
        }
        
?>
</select>
<input type="submit" value="Modificar Usuario" name="Eliminar">
</form>
  </div>
</div>
<?php
if (isset($_POST['subElim'])) {
  $resulEliminUsu=eliminarUsuario($conexion,$_POST['el']);
  if ($resulEliminUsu) {
    ?>
    <div class="card">
  <div class="card-header">
    Proceso correcto
  </div>
  <div class="card-body">
    <h5 class="card-title">El usuario se elimino correctamente</h5>
    <a href="adminUsuario.php" class="btn btn-primary">Eliminar mensaje</a>
  </div>
</div>
    <?php
  }else{
    ?>
    <div class="card">
  <div class="card-header">
    Error
  </div>
  <div class="card-body">
    <h5 class="card-title">No se pudo eliminar el usuario</h5>
    <a href="adminUsuario.php" class="btn btn-primary">Eliminar mensaje</a>
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
    <script src="js/script.js"></script>
    <script src="js/validacionLogin.js"></script>
</body>
</html>