<?php
session_start();
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

    <a class="navbar-brand" href="#">Navbar scroll</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
        <li class="nav-item active">
          <a class="nav-link" href="secciones.php">Secciones</a>
        </li>
      </ul>
      <ul class="nav navbar-nav">
      <?php
          if(isset($_SESSION['usuario'])){
            if($_SESSION['Rol']=="admin"){
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?php echo  "Bienvenido ".$_SESSION['usuario']; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="mostrarProductosComprar.php">Cesta</a></li>
                  <li><a class="dropdown-item" href="subirProducto.php">Subir producto</a></li>
                  <li><a class="dropdown-item" href="mostrarProductosVenta.php">mostrarProductosVenta</a></li>
                  <li><a class="dropdown-item" href="adminUsuario.php">Panel usuario</a></li>
                  <li><a class="dropdown-item" href="adminProducto.php">Panel productos</a></li>
                  <li><a class="dropdown-item" href="adminSeccion.php">Panel Seccion</a></li>
                  <li><a class="dropdown-item" href="adminComentario.php">Panel Comentarios</a></li>
                  <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Usuario</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Eliminar Usuario</a></li>
                </ul>
              </li>
              <?php
            }else if($_SESSION['Rol']=="usuario"){
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?php echo  "Bienvenido ".$_SESSION['usuario']; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="mostrarProductosComprar.php">Cesta</a></li>
                  <li><a class="dropdown-item" href="subirProducto.php">Subir producto</a></li>
                  <li><a class="dropdown-item" href="modificarUsuario.php">Modificar usuario</a></li>
                  <li><a class="dropdown-item" href="mostrarProductosVenta.php">mostrarProductosVenta</a></li>
                  <li><a class="dropdown-item" href="eliminarUsuario.php">Eliminar Usuario</a></li>
                  <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Usuario</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Eliminar Usuario</a></li>
                </ul>
              </li>
              
              <?php
            }
       

          }else{
        ?>
        
        <li class="nav-item">
          <a class="nav-link" href="login.php">
            Log in
          </a>
        </li>
        <li>
          <a class="nav-link" href="ingreso.php">
            Registrarse
          </a>
        </li>
        <?php
          }
        ?>
        
      </ul>
    </div>
  </nav>