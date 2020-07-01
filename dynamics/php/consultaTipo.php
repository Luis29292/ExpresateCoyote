<?php
  /*Archivo encargado de mandar a un JS (fetch) el tipo de usuario del usuario que está usando el sistema */
  include "./conexion.php";
  if ($conexion)
  {
    session_name("usuario");
    session_start();
    $usuario = $_SESSION['usu'];
    $consultaTipo = "SELECT Tipo FROM USUARIO WHERE id_usuario = '$usuario'";
    $respuestaTipo = mysqli_query($conexion, $consultaTipo);
    $tipoArreglo = mysqli_fetch_array($respuestaTipo, MYSQLI_ASSOC);
    $tipo = $tipoArreglo["Tipo"];
    echo $tipo;
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
 ?>
