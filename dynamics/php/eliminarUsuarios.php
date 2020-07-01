<?php
  //Aquí se borra de la base de datos al usuario que el administrador haya decidido eliminar
  include './conexion.php';
  if ($conexion)
  {
    if (isset($_POST['id_usuario']))
    {
      $idUsuario = strip_tags($_POST['id_usuario']);
      $idUsuario = mysqli_real_escape_string ($conexion, $idUsuario);
      $sql = "DELETE FROM usuario WHERE id_usuario LIKE \"$idUsuario\"";
      mysqli_query($conexion, $sql);
      header('Location: ./adminUsuarios.php');
    }
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
