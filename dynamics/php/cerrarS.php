<?php
  //Aquí cerramos la sesión del usuario y redireccionamos al inicio de sesión
  header('Location: ../../templates/inicioSesion.html');
  session_name("usuario");
  session_start();
  session_unset();
  session_destroy();
?>
