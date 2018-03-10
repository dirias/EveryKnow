<!DOCTYPE html>
<?php
  include "Php/conexion.php";
?>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/boots/bootstrap.css">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <header class="row">
          <nav class="col-md-offset-2 col-md-4">
            <ul >
                <li style="color:#5CF582;"><img src="Resources/bom.png" alt="Logo no soportado" class="img img-responsive" style="float:left; margin-top: -18px " >Everyknow</li>
                <li>Home</li>
                <li>Quienes somos?</li>
                <li>Ayudanos a crecer</li>
            </ul>
          </nav>
          <form method="post" action="index.php">
              <div class="col-md-2">
                <input type="text" placeholder="Usuario" class="form-control " name="us">
              </div>
              <div class="col-md-2">
                    <input type="password" placeholder="Contraseña" class="form-control " name="pw">
              </div>
              <div class="col-md-2">
                  <input type="submit" value="Ingresar" class="btn btn-primary" name="login">
              </div>
              <?php
                autoIncrement();
                  if(isset($_POST["login"]))
                  {
                    if(($_POST["us"] != "") && ($_POST["pw"] != ""))
                    {
                      login($_POST["us"] , $_POST["pw"] );
                    }
                    else {
                      echo "<script>alert(\"Debe de ingresar todos los datos.\");</script>";
                    }
                  }
              ?>
          </form>
        </header>
        <br><br>
        <div class="container">
            <div class="row ">
                <figure class="col-md-5 ">
                    <img src="Resources/avatar.png" alt="Icono de Inicio" class="img img-resposive icono">
                </figure>
                <form class="col-md-6 formregistrar verdeC" method="post" action="index.php">
                   <fieldset>
                      <legend>Registro de usuario</legend>
                      <div class="row form-group">
                       <br><br>
                            <div class=" col-md-6 ">
                                <input type="text" placeholder="Nombre" class="form-control" name="nombre">
                            </div>
                             <div class=" col-md-6 ">
                                <input type="text" placeholder="Apellidos" class=" form-control" name="apellidos">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="email" placeholder="Correo electrónico" class="form-control" name="correo">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class=" col-md-6 ">
                                <input type="text" placeholder="Nombre de usuario" class="form-control" name="user">
                            </div>
                             <div class=" col-md-6 ">
                                <input type="password" placeholder="Contraseña" class="form-control" name="con">
                            </div>
                        </div>
                        <br><br>
                        <div class="row form-group">
                            <div class=" col-md-2 col-md-offset-1 ">
                            <label for="genero"><input type="radio"  name="genero" value = "Mujer"> Mujer</label>
                            </div>
                            <div class=" col-md-3 ">
                                <label for="genero"><input type="radio"  name="genero" value = "Hombre"> Hombre</label>
                            </div>
                            <div class=" col-md-6 ">
                                <strong ><a >Términos y condiciones</a></strong>
                            </div>
                        </div>
                        <div class="row form-group">
                           <br><br>
                           <div class=" col-md-6 col-md-offset-1 ">
                                 <label><input type="checkbox" value="He leído los términos y condiciones"  name="chbTerminos"> He leído los términos y condiciones</label>
                            </div>
                            <div class="col-md-4 ">
                                <input type="submit" value="Crear cuenta" name="registrar" class="btn btn-success btn-lg">
                            </div>
                        </div>
                   </fieldset>
                </form>
                <?php
                if (isset($_POST["registrar"]))
                {
                  #echo "<script>alert(\"Has presionado el botón\");</script>";
                  if(isset($_POST["chbTerminos"]))
                  {
                    if(($_POST["nombre"] != "") && ($_POST["apellidos"] != "") && ($_POST["correo"] != "") && ($_POST["user"] != "")
                    && ($_POST["con"] != "") && isset($_POST["genero"]))
                    {
                      #echo "<script>alert(\"Has ingresado todos los datos\");</script>";
                                $pCon = encrypt($_POST['con'], "abcd1234554321");
                                $numero = autoIncrement();
                                //registro en la tabla user
                                $qUser = "INSERT INTO user (id,nombre, apellidos,correo,genero)
                                          VALUES ('".$numero."','".$_POST['nombre']."',' ".$_POST['apellidos']."','".$_POST['correo']."',
                                          '".$_POST['genero']."')";
                                registrarDatos($qUser);
                                //Registro en la tabla login
                                $qLogin = "INSERT INTO login(id,user,pw,estado) values('".$numero."','".$_POST['user']."','".$pCon."','Desconectado')";
                                registrarDatos($qLogin);

                                //creo la variable de sesion y direcciono a Bienvenido.php
                                $_SESSION["usuario"] = $_POST["user"] ;
                                echo "<script language='JavaScript'>location.href = 'bienvenido.php'</script>";
                    }
                    else
                    {
                      echo "<script>alert(\"Debes de ingresar todos los datos solicitados\");</script>";
                    }
                  }
                  else
                  {
                    echo "<script>alert(\"Debes aceptar los términos y condiciones\");</script>";
                  }
                }
                 ?>
            </div>
        </div>
        <footer>
            <p class="text-center">Done by Didier</p>
        </footer>
    </body>
</html>
