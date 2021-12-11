<?php
require 'BD/ConectorBD.PHP';
require 'BD/DAOUsuario.PHP';
require 'BD/DAOProducto.PHP';
require 'BD/DAOSeccion.PHP';


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

<body style="background-color: rgba(203, 216, 252, 0.603);">
    <?php
    if (isset($_SESSION['usuario'])) {
        ?>
        <div class="row d-flex justify-content-center" >
<form style="margin:0 auto; background-color: rgba(255, 99, 71, 0.678); padding-top: 20px;" class="col-8 rounded h-75 sombra" action="principal.php" method="POST" name="formulario" enctype="multipart/form-data">
        <h1 class="text-center">Ingreso</h1>  
        <div class="form-group col-12">
        <p class="text-center">Inserte la imagen para visualizarla.</p>
            <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>    
        </div>  
        <div class="form-group col-12">
            <label for="articulo">Nombre del articulo <i class="fas fa-user"></i></label>
            <input type="text" id="articulo" name="articulo" class="form-control" placeholder="Nombre del Articlo"> 
        </div>
        <div class="form-group col-12">
            <label for="precio">Precio de envio<i class="fas fa-lock"></i></label>
            <input type="number" name="precio" step="0.01" maxlength="4" class="form-control" placeholder="precio de envio">
        </div>
        <div class="form-group col-12">
            <label for="precio">Precio de salida<i class="fas fa-lock"></i></label>
            <input type="number" name="precioEnvio" step="0.01" maxlength="4" class="form-control" placeholder="precio de salida">
        </div>
        <div class="form-group col-12">
        <input id="upload" name="archivo" type="file" onchange="readURL(this);" class="form-control border-0">
                <label id="upload-label" for="upload" class="font-weight-light text-muted">Elija una imagen del producto</label>
               
        </div>
        <script>
            function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}
        </script>

        <div class="form-group col-12">
            <label for="Descripcion">Descripcion</label>
            <textarea name="Descripcion" maxlength="50" rows="3" cols="30"></textarea>
        </div>

</head>



<div class="form-group col-12">
    <label for="dias">Dias de subasta: <span id="demo"></label>
  <input type="range" min="1" max="10" value="5" name="dias" id="myRange">
</div>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
        <div class="form-group col-12">
            <label for="seccion">Seccion<i class="fas fa-user-tag"></i></label>
            <select name="seccion" class="bg-light" id="seccion">
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
        <a href="" class="col-12">Volver a Login</a>
        <input class="col-12 btn btn-primary" name="subirPro" type="submit" value="Subir Producto">
    </form>
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