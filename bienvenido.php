  <?php
  require "Php/homeLayoutHeader.php";
   ?>
   <br>
   <main class="container" >
     <legend>Configura rapidamente tu cuenta</legend>
     <div class="row">
       <form method="post" action="Bienvenido.php" enctype="multipart/form-data">
       <section class="updateFotoFT col-xs-12 col-ms-12 col-md-4  verdeC">
         <legend>Actualiza la foto de perfil</legend>

         <img src="<?php echo $file = imagen(); ?>" alt="No hay imagen" class="img img-responsive img-circle" width="250px" id = "pic"
         height="250px" style="margin-left:55px;">
        <br>
         <input type="file" name="pic" id="picBot" >
       </section>
       <div class="datosAdicionales col-xs-12 col-ms-12 col-md-7 col-md-offset-1 verdeC">

         <legend>Datos adicionales</legend>
         <input type="input" name="saludo" placeholder="Saludo de presentación" class="form-control form-group" autofocus>
         <div class="form-group row">
           <div class="col-md-6 ">
             <select class="form-control" name="ocupacion">
               <option style="background-color:#d1d1d1;">Grado académico</option>
               <span role="separator"></span>
               <option value="Escolar">Escolar</option>
               <option value="Universitario">Universitario</option>
               <option value="Profesional">Profesional</option>
             </select>
           </div>
           <div class="col-md-6">
             <input type="input" name="pais" placeholder="País de procedencia" class=" form-control">
           </div>
         </div>
         <textarea name="intereses" placeholder="Intereses propios" class="form-control form-group" rows="5" style="resize:none;"></textarea>
         <div class="col-md-8">
           <br>
           <div class="btn-group" role="group">
             <input type="submit" name="Guardar" value="Guardar datos" class="btn btn-success" >
             <input type="button" name="omitir" class="btn btn-success" value="Omitir configuración">
             <input type="button" name="Que" class="btn btn-success" value="?" data-toggle="modal" data-target="#info">
           </div>
         </div>
         <div class="col-md-8">
           <p id="errorMSJ"></p>
         </div>
       </div>
     </form>
       <?php
          function imagen()
          {
            $genero = "Hombre";
            if ($genero == "Hombre")
            {
              $file = "Resources/male.png";
            }
            else {
              $file = "Resources/female.png";
            }
            return $file;
          }//fin funci img
          function subirImg()
          {
            $username = $_SESSION["usuario"];
            $ruta = "pictures/"."$username";
            $uploadfile_temporal = $_FILES['pic']['tmp_name'];
            $uploadfile_nombre = $ruta.$_FILES['pic']['name'];

            if (is_uploaded_file($uploadfile_temporal))
            {
                move_uploaded_file($uploadfile_temporal,$uploadfile_nombre);
                return true;
            }
            else
            {

            return false;
            }
          }
          if(isset($_POST["Guardar"]))
          {
            if(($_POST["saludo"] == "") || ($_POST["pais"] == "") || ($_POST["intereses"] == "") || ($_POST["ocupacion"] == "Grado académico"))
            {
              echo"<script>
              document.getElementById('errorMSJ').innerHTML = '*Debe ingresar todos los datos.';
              </script>";
            }
            else if($_FILES['pic']['name'] == "")
            {
              echo"<script>
              document.getElementById('errorMSJ').innerHTML = '*Solo necesitamos tu foto, ya estamos finalizando :D.';
              </script>";
            }
            else
            {
              $id = getID($_SESSION["usuario"]);
              $query = "INSERT INTO pu(id,saludo,fotoPerfil,gradoAcademico,pais,intereses)
              value('".$id."','".$_POST['saludo']."',' ".$_FILES['pic']['name']."',' ".$_POST['ocupacion']."',
              ' ".$_POST['pais']."',' ".$_POST['intereses']."')";
              #registro los datos de la tabla PerfilUsuario(PU)
              registrarDatos($query);
              #registro los datos de la tabla fotosusers
              $query = "INSERT INTO fotosusers(id,foto,category)
              value('".$id."','".$_FILES['pic']['name']."','".'intereses'."')";
              registrarDatos($query);
              if(true)
              {
                savePhoto($_SESSION["usuario"]);
              }
            }
          }
          ?>
     </div>
     <br>
     <br>
     <div class="row">
       <section class="tutorial col-xs-12 col-ms-12 col-md-12 verdeC">
         <legend>Algunos tips por si ocupás ayuda con tu cuenta</legend>
       </section>
     </div>
     <br>
   </main>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="info">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function init() {
  var inputFile = document.getElementById('picBot');
  inputFile.addEventListener('change', mostrarImagen, false);
}

function mostrarImagen(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(event) {
    var img = document.getElementById('pic');
    img.src= event.target.result;
}
reader.readAsDataURL(file);
}

window.addEventListener('load', init, false);
</script>
  <?php
  require "Php/homeLayoutFooter.php";
   ?>
