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
<body>
<?php
//Modificar seccion
if (isset($_POST['modificarSeccion'])) {
    $SModify=consultaSeccionPorId($conexion,$_POST['secMody']);
    $seccMody=mysqli_fetch_assoc($SModify);
    echo $seccMody['nombreSec'];
    ?>
<form class="row" action="adminSeccion.php" method="POST" name="formulario" enctype="multipart/form-data">
        <div class="form-group col-12">
            <label for="seccion">Nombre del sección: <small><?php echo $seccMody['nombreSec']; ?></small> <i class="fas fa-user"></i></label>
            <div>
                <input class="col-4" type="text" id="seccionN" name="seccionN" class="form-control" placeholder="Enter User"> 
            </div>
        </div>
        <div class="form-group col-12">
        Añadir imagen: <small><?php echo $seccMody['image']; ?></small> <input name="archivoSm" id="archivoSm" type="file"/>
        </div>
        <div class="form-group col-12">
        
            <label for="informacion">informacion</label>
            <div>
                <textarea name="informacion" maxlength="50" rows="3" cols="30"></textarea>
            </div>
            <div class="col-2"><small ><?php echo $seccMody['info']; ?></small></div>
        </div>
        <input type="hidden" name="idSeccMo" value="<?php echo $_POST['secMody']; ?>">
        <div class="col-12"><input name="modificarSeccion" type="submit" value="Enviar"></div>
    </form>
    <?php
}
//Crear seccion
if (isset($_POST['crearSec'])) {
   
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
       //Obtenemos algunos datos necesarios sobre el archivo
       $tipo = $_FILES['archivo']['type'];
       $tamano = $_FILES['archivo']['size'];
       $temp = $_FILES['archivo']['tmp_name'];
       //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
      if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
         echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
         - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
      }
      else {
         //Si la imagen es correcta en tamaño y tipo
         //Se intenta subir al servidor
         if (move_uploaded_file($temp, 'images/'.$archivo)) {
             //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
             chmod('images/'.$archivo, 0777);
             //Mostramos el mensaje de que se ha subido co éxito
             echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
         }
         else {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
         }
       }
    }
    $nombre=$_POST['seccion'];
    $info=$_POST['informacion'];
    $ubiArchivo="images/$archivo";
    echo $info."   ".$nombre."   ".$ubiArchivo;
    $ResulInserSecc=insertarSeccion($conexion,$nombre,$info,$ubiArchivo);
   if ($ResulInserSecc) {
     ?>
     <div class="card">
         <div class="card-header">
             Featured
         </div>
         <div class="card-body">
         <img src="images/<?php echo $archivo; ?>">
             <h5 class="card-title">Se introdujo correctamente la seccion <?php echo $nombre; ?></h5>
             <a href="adminSeccion.php" class="btn btn-primary">Volver al administrador de sección</a>
         </div>
     </div>
     <?php 
   }
 }

//eliminar producto
if (isset($_POST['EliminarPro'])) {
    echo $_POST['proElim'];
   $idPr=$_POST['proElim'];
    $produE=consultaProductoPorId($conexion,$_POST['proElim']);
        $produElim=mysqli_fetch_assoc($produE);
        $produES=consultaMaximaPujaProductos($conexion,$_POST['proElim']);
        $produElimPuja=mysqli_fetch_assoc($produES);
        echo $produElimPuja['max(valor)'];
    $fecha_actual = date("Y-m-d H:i:s");
    if($produElim['fechaIni']>$fecha_actual){
        ?>
    <div class="card">
        <div class="card-header">
            Todavia no esta en subasta
        </div>
        <div class="card-body">
            <h5 class="card-title">El articulo <?php echo $produElim['titulo'] ?> aun no esta a la venta esta Seguro que desea eliminarlo</h5>
           <form action="adminProducto.php" method="post">
           <input class="btn btn-danger" type="submit" value="Eliminar" name="confEliminar">
           <input type="hidden" name="idProducto" value="<?php echo $idPr; ?>">
           <input type="hidden" name="titu" value="<?php echo $produElim['titulo'] ?>">
           </form>
        </div>
    </div>
    <?php 
     
    }elseif ($produElim['fechaIni']<$fecha_actual && $produElim['fechaFin']>$fecha_actual) {
        $HorasRestric="12";
        $fechaA = date("Y-m-d H:i:s");
    $restriccionH=date("Y-m-d H:i:s",strtotime($produElim['fechaFin']."- $HorasRestric Hour"));
        if ($fechaA<$restriccionH) {
            //antes de las 12 horas para el final
            ?>
            <div class="card">
                <div class="card-header">
                El articulo <?php echo $produElim['titulo'] ?> aun  esta a la venta esta Seguro que desea eliminarlo
                </div>
                <div class="card-body">
                    <h5 class="card-title">Este producto esta aun en subasta eliminarlo supondria, eliminar las pujas y interaccion entre los usuarios intentaban comprar este producto</h5>
                    <form action="adminProducto.php" method="post">
           <input class="btn btn-danger" type="submit" value="Eliminar" name="confEliminar">
           <input type="hidden" name="idProducto" value="<?php echo $idPr; ?>">
           <input type="hidden" name="titu" value="<?php echo $produElim['titulo'] ?>">
           </form>
                </div>
            </div>
            <?php 
        }else{
            //despues de las 12 horas para el final
            ?>
            <div class="card">
                <div class="card-header">
                El articulo <?php echo $produElim['titulo']."  ".$restriccionH ?> no se puede eliminar ya que esta a menos de 12 horas para el final de su puja
                </div>
                <div class="card-body">
                    <h5 class="card-title">Demasiado tarde, por la estabilidad de la web este producto ya no podra ser borrado hasta los 15 dias posteriores a su venta</h5>
                    <a href="adminProducto.php" class="btn btn-primary">Volver al administrador de Productos</a>
                </div>
            </div>
            <?php 
        }
       
       
        //Dentro de la fecha de subasta
    }else{
       //Despues de la fecha de fin
        echo $produElimPuja['max(valor)'];
        if ($produElimPuja['max(valor)']!=0 && $produElimPuja['max(valor)']!=null) {
            $diasRestric="15";
            $fecha_actual = date("Y-m-d H:i:s");
        $restriccion=date("Y-m-d H:i:s",strtotime($produElim['fechaFin']."+ $diasRestric day"));
            if ($restriccion>$fecha_actual) {
                // aun no pasaron los 15 dias
                ?>
        <div class="card">
            <div class="card-header">
            El articulo <?php echo $produElim['titulo'] ?> Se vendio
            </div>
            <div class="card-body">
                <h5 class="card-title">Este articulo se vendio el <?php echo $produElim['fechaFin']; ?> No se podra eliminar hasta 15 dias posteriores a su venta es decir el <?php echo $restriccion; ?></h5>
                <a href="adminProducto.php" class="btn btn-primary">Volver al administrador de Productos</a>
            </div>
        </div>
        <?php 
            }else{
                //Pasaron los 15 dias se puede eliminar
                ?>
        <div class="card">
            <div class="card-header">
            El articulo <?php echo $produElim['titulo']; ?> Se vendió
            </div>
            <div class="card-body">
            <h5 class="card-title">Este articulo se vendio el <?php echo $produElim['fechaFin']; ?> sus restricciones para eliminarlo acabaron el  <?php echo $restriccion; ?>. ¿Esta seguro de que desea eliminarlo?</h5>
            <form action="adminProducto.php" method="post">
           <input class="btn btn-danger" type="submit" value="Eliminar" name="confEliminar">
           <input type="hidden" name="idProducto" value="<?php echo $idPr; ?>">
           <input type="hidden" name="titu" value="<?php echo $produElim['titulo'] ?>">
           </form>
            </div>
        </div>
        <?php 
            }
        }else {
            ?>
        <div class="card">
            <div class="card-header">
            El articulo <?php echo $produElim['titulo']; ?> termino su plazo de venta y no obtuvo ninguna puja
            </div>
            <div class="card-body">
                <h5 class="card-title">Estas seguro de que desea eliminar este usuario</h5>
                <form action="adminProducto.php" method="post">
           <input class="btn btn-danger" type="submit" value="Eliminar" name="confEliminar">
           <input type="hidden" name="idProducto" value="<?php echo $idPr; ?>">
           <input type="hidden" name="titu" value="<?php echo $produElim['titulo'] ?>">
           </form>
            </div>
        </div>
        <?php 
        }
    }
    
}
//modificar producto 
if (isset($_POST['modiProduct'])) {
    echo $_POST['proMody'];
    
    $prod=consultaTodosProductos($conexion);
        $pro=mysqli_fetch_assoc($prod);
    ?>
<form class="row" action="adminProducto.php" method="POST" name="formulario" enctype="multipart/form-data">
        <input type="hidden" name="idPro" value="<?php echo $_POST['proMody']; ?>">
        <div class="form-group col-12">
            <div><small><b>Nombre: </b><?php echo $pro['titulo']; ?></small></div>
            <label for="articulo">Nombre del articulo <i class="fas fa-user"></i></label>
            <input type="text" id="articulo" name="articulo" class="form-control" placeholder="Enter User"> 
        </div>
       
        <div class="form-group col-12">
            <div><small><b>Nombre: </b><?php echo $pro['precioInicial']; ?> Euros</small></div>
            <label for="precio">Precio de salida<i class="fas fa-lock"></i></label>
            <input type="number" name="precio" step="0.01" maxlength="4" class="form-control" placeholder="Enter password">
        </div>
        <div class="form-group col-12">
        Modificar imagen: <input name="archivo" id="archivo" type="file"/>
        </div>
        

        <div class="form-group col-12">
        
            <label for="Descripcion">Descripcion</label>
            <textarea name="Descripcion" maxlength="50" rows="3" cols="30"></textarea>
            <small><b>Nombre: </b><?php echo $pro['Descripcion']; ?> </small>
        </div>

        <div class="form-group col-12">
            <label for="seccion" class="col-2">Seccion<i class="fas fa-user-tag"></i></label>
            <select name="seccion" class="col-9" id="seccion">
                    <option value="0">Identificador-Usuario</option>
                    <?php
                            $Sec=consultaSeccion($conexion);
                            While($seccion=mysqli_fetch_assoc($Sec)){
                    ?>
                    <option value="<?php echo $seccion['idSeccion']; ?>"><?php echo $seccion['nombreSec']; ?></option>
                    


                    <?php
                }
?>
        </div>
        <div class="col-12"><input class="col-5" name="modiProd" type="submit" value="modificar"></div>
    </form>
    
    <?php
  
}
//Si se quiere subir una imagen
if (isset($_POST['crearPro'])) {
   
   //Recogemos el archivo enviado por el formulario
   $archivo = $_FILES['archivo']['name'];
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
     }
     else {
        //Si la imagen es correcta en tamaño y tipo
        //Se intenta subir al servidor
        if (move_uploaded_file($temp, 'images/'.$archivo)) {
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            chmod('images/'.$archivo, 0777);
            //Mostramos el mensaje de que se ha subido co éxito
            echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
        }
        else {
           //Si no se ha podido subir la imagen, mostramos un mensaje de error
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
      }
   }
   $articulo=$_POST['articulo'];
   $precio=$_POST['precio'];
   $Descripcion=$_POST['Descripcion'];
   $dias=$_POST['dias'];
   $fecha_actual = date("Y-m-d H:i:s");
   $fechaFin=date("Y-m-d H:i:s",strtotime($fecha_actual."+ $dias day"));
  
   $seccion=$_POST['seccion'];
   $ubiArchivo="images/$archivo";
   $ResulInserPro=insertarProducto($conexion,$_SESSION['idUsuario'],$fecha_actual,$fechaFin,$precio,$seccion,$ubiArchivo,$Descripcion,$articulo,$_POST['precioEnvio']);
  if ($ResulInserPro) {
    ?>
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
        <img src="images/<?php echo $archivo; ?>">
            <h5 class="card-title">Se introdujo correctamente el producto <?php echo $articulo; ?></h5>
            <a href="adminProducto.php" class="btn btn-primary">Volver al administrador de Productos</a>
        </div>
    </div>
    <?php 
  }
}
?>

<?php
       if (isset($_POST['crear'])) {
         
            echo "h";
            $usuario=$_POST['usuario'];
            $contra=$_POST['password'];
            $nombre=$_POST['nombre'];
            $apellidos=$_POST['apellidos'];
            $dni=$_POST['dni'];
            $rol=$_POST['rol'];
            $comunidad=$_POST['comunidad'];
            $provincia=$_POST['provincia'];
            $cp=$_POST['cp'];
            $telefono=$_POST['telefono'];
            $email=$_POST['email'];
            $direccion=$_POST['direccion'];
            echo $telefono."-".$email."-".$usuario."-".$contra."-".$nombre."-".$apellidos."-".$dni."-".$comunidad."-".$provincia."-".$cp."-".$direccion."-".$rol;
            if ($usuario!="" && $usuario!=null && $contra!="" 
            && $contra!=null && $nombre!="" && $nombre!=null && $apellidos!="" && $apellidos!=null 
            && $dni!=null && $dni!="" && $direccion!=null && $direccion!="") {
              $resulM=crearUsuarioAdmin($conexion,$telefono,$email,$usuario,$contra,$nombre,$apellidos,$dni,$comunidad,$provincia,$cp,$direccion,$rol);           
              $_SESSION['UsuarioN']=true;
            
        if($resulM){
            ?>
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Se introdujo correctamente el usuario <?php echo $usuario; ?></h5>
                    <a href="adminUsuario.php" class="btn btn-primary">Volver al administrador de usuario</a>
                </div>
            </div>
            <?php
            }else{
            ?>
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Hubo un error al introducir el usuario <?php echo $usuario; ?></h5>
                    <a href="adminUsuario.php" class="btn btn-primary">Volver al administrador de usuario</a>
                </div>
            </div>
        <?php
          }
        }
    }
    //modificar comentario
    if (isset($_POST['moComentario'])) {
        echo $_POST['MoComMody'];
        $resAntCom=consultaComentarioPorId($conexion,$_POST['MoComMody']);
        $rCM=mysqli_fetch_assoc($resAntCom);
        ?>
<form class="row" action="adminComentario.php" method="POST" name="formulario" enctype="multipart/form-data">
        <div class="form-group col-6">
            <label for="seccion">Usuario<i class="fas fa-user"></i><small>id del valor anterior: <?php echo $rCM['idUsuario']; ?></small></label>
            
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
        <label for="seccion">Producto<i class="fas fa-user"></i><small>id del valor anterior: <?php echo $rCM['idProducto']; ?></small></label>
            
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
            <textarea name="Contenido" maxlength="199" rows="3" cols="30"></textarea><small><?php echo $rCM['contenido']; ?>
        </div>
        <div class="form-group col-6">
            <label for="fechaMo">fechaMo</label>
                <input type="date" name="fechaMo" id=""><small><?php echo $rCM['fecha']; ?>
        </div>
        <input type="hidden" name="idComentario" value="<?php echo $_POST['MoComMody']; ?>">
        <div class="col-12"><input name="moComentario" class="btn btn-primary" type="submit" value="Enviar"></div>
    </form>
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