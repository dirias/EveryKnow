<?php
  include "Php/conexion.php";
 ?>
<!DOCTYPE html>
<html>
  <head lang="es">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/boots/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/Bienvenido.css">
    <link rel="stylesheet" href="css/home.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>Everyknow</title>
  </head>
  <body>
      <header class="row">
        <nav class=" col-md-offset-2 col-md-10 ">
          <ul >
              <li style="color:#5CF582;"><img  for="menuL" src="Resources/bom.png" alt="Logo no soportado" class="img img-responsive"
                 style="float:left; margin-top: -18px " >Everyknow</li>
              <li>Home</li>
              <li>Cuenta</li>
              <li>Zona de estudio</li>
              <li class="col-md-offset-4"></li>
              <li><?php echo $_SESSION["usuario"];?></li>
              <li onclick="salir();">Cerrar sesión </li>
          </ul>
        </nav>
      </header>
