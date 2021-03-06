<?php
  //Aquí es donde validamos los datos que el alumno o profesor ingresa en el formulario para saber si ya está registrado
  //Ya sea que ingrese su correo, RFC o su número de cuenta y su contraseña, según sea el caso
  //Estos datos se encriptan y se hashean (contraseña)
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
    $coN = base64_encode($coN);//Pasa el texto a base 64
    $coN = bin2hex ($coN);
    $coA = base64_encode($coA);//Pasa el texto a base 64
    $coA = bin2hex ($coA);
    $cA = $cA."EBaTdDtDFDtGZ4uBnqmq3BvANFU2J2";
    $cA = hash('sha256', $cA);
    $cN = $cN."EBaTdDtDFDtGZ4uBnqmq3BvANFU2J2";
    $cN = hash('sha256', $cN);
    $usu = $_SESSION['usu'];
    if ($coA != "" && $coN != "")
    {
      $vCorreo = "SELECT correo FROM usuario WHERE id_usuario LIKE \"$usu\" OR correo LIKE \"$usu\"";
      $vCor = mysqli_query($conexion, $vCorreo);
      $vCo = mysqli_fetch_array($vCor);
      if ($vCo[0] == $coA)
      {
        mysqli_real_escape_string ($conexion, $coN);
        $nCorreo = "UPDATE usuario SET correo =\"$coN\" WHERE id_usuario LIKE \"$usu\" OR Correo LIKE \"$usu\"";
        mysqli_query($conexion, $nCorreo);
        $_SESSION['usu']=$coN;
        header('Location: ./perfil.php');
      }
      else
      {
        echo "El correo anterior no coincide.<br>
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
        header('Location: ./perfil.php');
      }
      else
      {
        echo "La contraseña anterior no coincide.<br>
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
