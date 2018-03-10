<?php
session_start();
echo "Hola";

$conn = new mysqli("localhost","rikydier", "didier20","everyknow");
$sql = "UPDATE login SET estado = 'Desconectado' WHERE user = '".$_SESSION['usuario']."'";
  if ($conn->query($sql) === TRUE) {
    header("location: index.php");
    }
    else
    {
        echo "Error al actualizar: " . $conn->error;
    }
    $conn->close();
?>
