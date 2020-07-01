<?php
  //Aquí se realizan los cambios de correo o contraseña si el administrador así lo decide, al igual si los datos no coinciden con los registrados en la base de datos
  echo '<!DOCTYPE html>
        <html lang="es" dir="ltr">
          <head>
            <link rel="stylesheet" href="../../statics/css/configuracion.css">
            <link rel="icon" href="../../statics/img/logo.jpg">
            <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
            <meta charset="utf-8">
            <title>Validando...</title>
          </head>
          <body>
            <div class="error">';
  session_name("usuario");
  session_start();
  include "./conexion.php";
  if ($conexion)
  {
    $coA = (isset($_POST['coA']))?$_POST['coA']:"";
    $coA = strip_tags($coA);
    $coN = (isset($_POST['coN']))?$_POST['coN']:"";
    $coN = strip_tags($coN);
    $cA = (isset($_POST['cA']))?$_POST['cA']:"";
    $cA = strip_tags($cA);
    $cN = (isset($_POST['cN']))?$_POST['cN']:"";
    $cN = strip_tags($cN);
    $usu = $_SESSION['usu'];
    if ($coA != "" && $coN != "")
    {
      $vCorreo="SELECT correo FROM usuario WHERE id_usuario LIKE \"$usu\" OR correo LIKE \"$usu\"";
      $vCor = mysqli_query($conexion,$vCorreo);
      $vCo = mysqli_fetch_array($vCor);
      if ($vCo[0] == $coA){
        mysqli_real_escape_string ($conexion, $coN);
        $nCorreo = "UPDATE usuario SET correo =\"$coN\" WHERE id_usuario LIKE \"$usu\" OR Correo LIKE \"$usu\"";
        mysqli_query($conexion, $nCorreo);
        $_SESSION['usu']=$coN;
        header('Location: ./perfil.php');
      }
      else
      {
        echo
        "El correo anterior no coincide.<br>
        <a href='../../templates/configuracion.html'>Regresar</a>";
      }
    }
    elseif ($cA != "" && $cN != "")
    {
      $vContraseña="SELECT Contrasena FROM usuario WHERE id_usuario LIKE \"$usu\" OR correo LIKE \"$usu\"";
      $vContra = mysqli_query($conexion, $vContraseña);
      $vCon = mysqli_fetch_array($vContra);
      if ($vCon[0] == $cA)
      {
        mysqli_real_escape_string ($conexion, $cN);
        $nContra = "UPDATE usuario SET Contrasena =\"$cN\" WHERE id_usuario LIKE \"$usu\" OR Correo LIKE \"$usu\"";
        mysqli_query($conexion, $nContra);
      }
      else
      {
        echo
        "La contraseña anterior no coincide.<br>
        <a href='../../templates/configuracion.html'>Regresar</a>";
      }
    }
    else
    {
      header('Location: ../../templates/configuracion.html');
    }
  }
  echo "</div>
      </body>
    </html>";
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
