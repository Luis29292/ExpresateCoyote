<?php
  //Aquí inicia sesión el alumno o profesor, obtenemos de la base de datos su coreo o RFC o número de cuenta (según sea el caso), lo descriframos y comparamos con lo ingresado
  //La contraseña sólo se compara con la ingresada, puesto a que está hasheada
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
      $usu = base64_encode($usu);
      $usu = bin2hex ($usu);
    }

    if(isset($_POST['contra']))
    {
      strip_tags($_POST['contra']);
      $contraseña = $_POST['contra'];
      $contraseña = $contraseña."EBaTdDtDFDtGZ4uBnqmq3BvANFU2J2";
      $contraseña = hash('sha256', $contraseña);
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

      $identificador = "SELECT id_usuario FROM usuario WHERE Contrasena LIKE \"$contraseña\"";
      $respuesta2= mysqli_query($conexion, $identificador);
      $row2 = mysqli_fetch_array($respuesta2);
      $deci = hex2bin($row2[0]);
      $deci = base64_decode($deci);
      $_SESSION['usu'] = $usu;
    }

    elseif ($row2[0]==$contraseña)
    {
      header('Location: ./perfil.php');
      session_name("usuario");
      session_start();

      $identificador = "SELECT id_usuario FROM usuario WHERE Contrasena LIKE \"$contraseña\"";
      $respuesta2 = mysqli_query($conexion, $identificador);
      $row2 = mysqli_fetch_array($respuesta2);
      $deci = hex2bin($row2[0]);
      $deci = base64_decode($deci);
      $_SESSION['usu'] = $usu;
    }
    else
    {
      echo "El usuario o la contraseña son incorrectos <br><br>
            <a href='../../templates/inicioSesion.html'>Regresar</a>";
    }
  }
  echo '</div>
      </body>
    </html>';
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
