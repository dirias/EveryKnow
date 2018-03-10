<?php
session_start();
function openConexion()#creo la conexion con mysql PDO
{
  $servername = "localhost";
  $username = "rikydier";
  $password = "didier20";
  $dbname = "everyknow";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}
#------------------------------------------------------------------------------------------Procedimiento para registrar al usuario
function registrarDatos($query)
{
  try {
    $conn = openConexion();

    $conn->exec($query);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
  $conn = null;
}

#-----------------------------------------------------------------------------------------Login
function login($pUser, $pPW)
{
try {
  $pwE = encrypt($pPW,"abcd1234554321");
  $conn = openConexion();
  $result = $conn->prepare("SELECT user, pw,estado FROM login WHERE user = \"$pUser\" AND pw = \"$pwE\"");
  $result->execute();
  if($result = $result->fetch(PDO::FETCH_ASSOC))
    {
      $_SESSION["usuario"] = $pUser ;
      #-----------------------Código para actualizar el estado del Usuario
      $result = $conn->prepare("UPDATE login SET Estado = 'Conectado' WHERE user = \"$pUser\"");
      $result->execute();
      header("location: home.php");
    }
    else {
      echo "Datos erroneos";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
}
#---------------------------------------------------------Método de log off utilizando MSQLI, Debo cambiarlo a PDO
function logoff()
{
  $conn = openConexion();
  $sql = "UPDATE login SET estado = 'Desconectado' WHERE user = '".$_SESSION['usuario']."'";
  if ($conn->query($sql) === TRUE) {
    header("location: index.php");
    }
    else
    {
        echo "Error al actualizar: " . $conn->error;
    }
    $conn->close();
}
#---------------------------------------------------------------------------------------------------------Metodos de encriptar y desencriptar
#DONE
function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}
function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}

#------------------------------------------------------------------DONE
//Method to autoIncrement the ID

function autoIncrement()
{
  try {
      $conn = openConexion();
      $nume = $conn->query("SELECT count(*)   FROM user")->fetchColumn();
      return $nume + 1;
    }
  catch(PDOException $e)
      {
      echo $sql . "<br>" . $e->getMessage();
      }
}
#--------------------------------------Funcion para retornar el id, para guardar la informacion adicional Bienvenido.phpinfo

function getID($username)
{
  try {
      $conn = openConexion();
      $id = $conn->query("SELECT id FROM login WHERE user = \"$username\"")->fetchColumn();
      return $id;
      echo "<script>alert(\"$id\");</script>";
    }
  catch(PDOException $e)
      {
      echo  "<br>" . $e->getMessage();
      }
}
function savePhoto($username)
{
  $path = "pictures/"."$username";
  if(!file_exists($path)){
    mkdir($path);
  }
  $uploadfile_temporal = $_FILES['pic']['tmp_name'];
  $uploadfile_nombre = $path."/".$_FILES['pic']['name'];

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
?>
