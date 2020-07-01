<?php
  //Aquí es donde validamos los datos que el administrador ingresó y verificamos si es un administrador registrado en la base de datos
  //No encriptamos ni hasheamos los datos puesto a que es administrador de la misma base de datos
  echo '<!DOCTYPE html>
        <html lang="en" dir="ltr">
          <head>
            <link rel="stylesheet" href="../../statics/css/ingreso.css">
            <link rel="icon" href="../../statics/img/logo.jpg">
            <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
            <meta charset="utf-8">
            <title>Validando...</title>
          </head>
          <body>
            <div class="error">';
  include "./conexion.php";
  if ($conexion)
  {
    if(isset($_POST['id_usuario']))
    {
      strip_tags($_POST['id_usuario']);
      $usu = $_POST['id_usuario'];
    }

    if(isset($_POST['contra']))
    {
      strip_tags($_POST['contra']);
      $contraseña = $_POST['contra'];
    }

    $usu = mysqli_real_escape_string ($conexion, $usu);
    $contraseña = mysqli_real_escape_string ($conexion, $contraseña);

    $ini = "SELECT Contrasena FROM usuario WHERE id_usuario LIKE \"$usu\"";
    $respuesta = mysqli_query($conexion, $ini);
    $row = mysqli_fetch_array($respuesta);

    $ini2 = "SELECT Contrasena FROM usuario WHERE Correo LIKE \"$usu\"";
    $respuesta2 = mysqli_query($conexion, $ini2);
    $row2 = mysqli_fetch_array($respuesta2);

    $row[0]=(isset($row[0]))?$row[0]:"";
    $row2[0]=(isset($row2[0]))?$row2[0]:"";

    if ($row[0] == $contraseña)
    {
      header('Location: ./perfil.php');
      session_name("usuario");
      session_start();

      $_SESSION['usu'] = $usu;
    }

    elseif ($row2[0]==$contraseña)
    {
      header('Location: ./perfil.php');
      session_name("usuario");
      session_start();

      $_SESSION['usu'] = $usu;
    }
    else
    {
      echo "El usuario o la contraseña son incorrectos <br><br>
      <a href='../../templates/inicioSesion.html'>Regresar</a>";
    }
  }
  echo "</div>
      </body>
    </html>";
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
