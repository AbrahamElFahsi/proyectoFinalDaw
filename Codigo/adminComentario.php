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
    <script src="ajax.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <?php include 'nav.php'; ?>
</head>
<body style="background-color: rgba(203, 216, 252, 0.603);">
    <div class="col-12 text-center"><h1>Panel de Administracion de Comentarios</h1></div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Listar Comentario
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
                  <div class="col-12 text-center"><h1 style="font-family: 'Tangerine', cursive;">Listar Comentarios</h1></div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">idComentario</th>
      <th scope="col">idUsuario</th>
      <th scope="col">contenido</th>
      <th scope="col">fecha</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $coment=consultaTodosComentarios($conexion);
        while($comentario=mysqli_fetch_assoc($coment)){
      ?>
    <tr>
      <th scope="row"><?php echo $comentario['idComentario']; ?></th>
      <td><?php echo $comentario['idUsuario']; ?></td>
      <td><?php echo $comentario['contenido']; ?></td>
      <td><?php echo $comentario['fecha']; ?></td>
      
      <?php
}
      ?>
    </tr>
   
  </tbody>
</table>
  </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Crear Comentario
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
                  <div class="col-12 text-center"><h1>Crear Comentario</h1></div>
  <form class="row" action="adminComentario.php" method="POST" name="formulario" enctype="multipart/form-data">
        <div class="form-group col-6">
            <label for="seccion">Usuario<i class="fas fa-user"></i></label>
            
  <select name="usuComen" id="usuComen">
  <option value="0">Identificador-Usuario</option>
  <?php
        $usuarios=todosUsuarios($conexion);
        While($usu=mysqli_fetch_assoc($usuarios)){
      ?>
<option value="<?php echo $usu['idUsuario']; ?>"><?php echo $usu['idUsuario']."-".$usu['usuario']; ?></option>
  
<?php
        }
?>
</select>
        </div>
        <div class="form-group col-6">
            <label for="seccion">Producto<i class="fas fa-user"></i></label>
            
  <select name="proComen" id="proComen">
  <option value="0">Identificador-Titulo</option>
  <?php
        $prod=consultaTodosProductos($conexion);
        While($pro=mysqli_fetch_assoc($prod)){
      ?>
<option value="<?php echo $pro['idProducto']; ?>"><?php echo $pro['idProducto']."-".$pro['titulo']; ?></option>
  
<?php
        }
?>
</select>
        </div>
        <div class="form-group col-6">
            <label for="Contenido">Contenido</label>
            <textarea name="Contenido" maxlength="199" rows="3" cols="30"></textarea>
        </div>
        <input type="hidden" name="fechaComen" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <div class="col-12"><input name="crerComen" type="submit" value="Enviar"></div>
    </form>
    
    </div>
</div>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Modificar Comentario
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
                  <div class="col-12 text-center"><h1>Modificar comentario</h1></div>
  <form action="admin.php" method="POST">
  <select name="MoComMody" id="MoComMody">
  <option value="0">IdentificadorComentario-Comentario</option>
  <?php
        $com=consultaTodosComentarios($conexion);
        While($moCom=mysqli_fetch_assoc($com)){
      ?>
<option value="<?php echo $moCom['idComentario']; ?>"><?php echo $moCom['idComentario']."-".substr($moCom['contenido'],0,20); ?></option>
  
<?php
        }
?>
</select>
<input type="submit" value="Modificar Comentario" name="moComentario">

</form>

  </div>
</div>
<div class="dropdown"  style="margin-bottom: 500px;">
  <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Eliminar Comentario
  </button>
  <div class="dropdown-menu col-12" style="margin:0 auto; background-color: rgba(255, 99, 71, 0.95); padding-top: 20px;" aria-labelledby="dropdownMenuButton">
                  <div class="col-12 text-center"><h1>Eliminar comentario</h1></div>
  <form action="adminComentario.php" method="POST">
  <select name="EliComMody" id="EliComMody">
  <option value="0">IdentificadorComentario-Comentario</option>
  <?php
        $com=consultaTodosComentarios($conexion);
        While($moCom=mysqli_fetch_assoc($com)){
      ?>
<option value="<?php echo $moCom['idComentario']; ?>"><?php echo $moCom['idComentario']."-".substr($moCom['contenido'],0,20); ?></option>
  
<?php
        }
?>
</select>
<input type="submit" value="Eliminar Comentario" name="elimiComentario">

</form>

  </div>
</div>
<?php
//eliminar Comentario
if (isset($_POST['elimiComentario'])) {
echo $_POST['EliComMody'];
    $resulElimComen=eliminarComentario($conexion, $_POST['EliComMody']);
    if ($resulElimComen) {
        ?>
    <div class="card">
        <div class="card-header">
            Se ejecutó correctamente
        </div>
        <div class="card-body">
        <h5>Se eliminó el comentario con id <?php echo $_POST['EliComMody']; ?></h5>
        <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje</a>    
    </div>
    </div>
    <?php 
    }
}

//Crear Comentario
    if (isset($_POST['crerComen'])) {
        echo $_POST['usuComen']."".$_POST['Contenido']."".$_POST['fechaComen'];
        $resuInserComen=insertarComentario($conexion,$_POST['usuComen'],$_POST['Contenido'],$_POST['proComen'],$_POST['fechaComen']);
        if ($resuInserComen) {
            ?>
    <div class="card">
        <div class="card-header">
            Inserción Correcta
        </div>
        <div class="card-body">
            <h5 class="card-title">Se introdujo correctamente el Comentario <?php echo $_POST['usuComen']; ?> con fecha <?php echo $_POST['fechaComen']; ?></h5>
            <a href="adminComentario.php" class="btn btn-primary">Volver al administrador de Comentarios</a>
        </div>
    </div>
    <?php 
        }else {
            ?>
    <div class="card">
        <div class="card-header">
            Hubo un error al introducir el comentario
        </div>
        <div class="card-body">
            <h5 class="card-title">Error al introducir el Comentario <?php echo $_POST['usuComen']; ?> con fecha <?php echo $_POST['fechaComen']; ?></h5>
            <a href="adminComentario.php" class="btn btn-primary">Volver al administrador de Comentarios</a>
        </div>
    </div>
    <?php 
        }
    }
    //modificar Comentario
    if (isset($_POST['moComentario'])) {
        echo $_POST['usuComen']."".$_POST['fechaMo']."".$_POST['proComen']."".$_POST['Contenido'];
        //modicar usuario que comenta   
        if ($_POST['usuComen']!=0 && $_POST['usuComen']!=null) {
            $modiResul=modificarComentario($conexion,$_POST['idComentario'],"idUsuario",$_POST['usuComen']);
            if ($modiResul) {
                ?>
    <div class="card">
        <div class="card-header">
            Se difico correctamente
        </div>
        <div class="card-body">
            <h5 class="card-title">Se modifico el id del usuario que comenta a <?php echo $_POST['usuComen']; ?></h5>
            <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje</a>
        </div>
    </div>
    <?php 
            }else {
                ?>
                <div class="card">
                    <div class="card-header">
                        Hubo un error al modificar el usuario que comenta
                    </div>
                    <div class="card-body">
                        <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje/a>
                    </div>
                </div>
                <?php  
            }
        }
                //modicar producto que se comenta   
                if ($_POST['proComen']!=0 && $_POST['proComen']!=null) {
                    $modiResul=modificarComentario($conexion,$_POST['idComentario'],"idProducto",$_POST['proComen']);
                    if ($modiResul) {
                        ?>
            <div class="card">
                <div class="card-header">
                    Se difico correctamente
                </div>
                <div class="card-body">
                    <h5 class="card-title">Se modifico el id del usuario que comenta a <?php echo $_POST['proComen']; ?></h5>
                    <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje</a>
                </div>
            </div>
            <?php 
                    }else {
                        ?>
                        <div class="card">
                            <div class="card-header">
                                Hubo un error al modificar el usuario que comenta
                            </div>
                            <div class="card-body">
                                <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje/a>
                            </div>
                        </div>
                        <?php  
                    }
                }
                //modicar fecha en que se comenta   
                if ($_POST['fechaMo']!="" && $_POST['fechaMo']!=null) {
                    $modiResul=modificarComentario($conexion,$_POST['idComentario'],"fecha",$_POST['fechaMo']);
                    if ($modiResul) {
                        ?>
            <div class="card">
                <div class="card-header">
                    Se difico correctamente
                </div>
                <div class="card-body">
                    <h5 class="card-title">Se modifico el la fecha del usuario que comenta a <?php echo $_POST['fechaMo']; ?></h5>
                    <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje</a>
                </div>
            </div>
            <?php 
                    }else {
                        ?>
                        <div class="card">
                            <div class="card-header">
                                Hubo un error al modificar el usuario que comenta
                            </div>
                            <div class="card-body">
                                <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje/a>
                            </div>
                        </div>
                        <?php  
                    }
                }
                                //modicar contenido que se comenta   
                                if ($_POST['Contenido']!="" && $_POST['Contenido']!=null) {
                                    $modiResul=modificarComentario($conexion,$_POST['idComentario'],"contenido",$_POST['Contenido']);
                                    if ($modiResul) {
                                        ?>
                            <div class="card">
                                <div class="card-header">
                                    Se difico correctamente
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Se modifico el contenido del comentario a <?php echo $_POST['Contenido']; ?></h5>
                                    <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje</a>
                                </div>
                            </div>
                            <?php 
                                    }else {
                                        ?>
                                        <div class="card">
                                            <div class="card-header">
                                                Hubo un error al modificar el usuario que comenta
                                            </div>
                                            <div class="card-body">
                                                <a href="adminComentario.php" class="btn btn-primary">Eliminar mensaje/a>
                                            </div>
                                        </div>
                                        <?php  
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