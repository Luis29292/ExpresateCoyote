<?php
  //Aquí se validan los datos ingresados en el formulario al momento de registrarse (alumno o profesor)
  //Verificar que sean correctos para así insertar estos datos en la base de dato y redireccionar al usuario a index.html
  echo '<!DOCTYPE html>
        <html lang="en" dir="ltr">
          <head>
            <link rel="stylesheet" href="../../statics/css/registro.css">
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
    $llen = true;
    strip_tags($_POST['name']);
    strip_tags($_POST['apaterno']);
    strip_tags($_POST['amaterno']);
    strip_tags($_POST['correoElec']);
    strip_tags($_POST['contra']);
    strip_tags(isset($_POST['fnacimi']));
    strip_tags(isset($_POST['ntrabajador']));
    strip_tags(isset($_POST['ncuenta']));
    strip_tags(isset($_POST['rfc']));

    if(isset($_POST['name']) && preg_match('/([A-ZÁÉÍÓÚÑ][a-záéíóúñ]*\s?){1,}/',$_POST['name']))
    {
      $nombre = $_POST['name'];
      $nombre = base64_encode($nombre);//Pasa el texto a base 64
      $nombre = bin2hex ($nombre);
    }
    else
    {
      $llen = false;
    }

    if(isset($_POST['apaterno']) && preg_match('/[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*/',$_POST['apaterno']))
    {
      $aP = $_POST['apaterno'];
    }
    else
    {
      $llen = false;
    }

    if(isset($_POST['amaterno']) && preg_match('/[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*/',$_POST['amaterno']))
    {
      $aM = $_POST['amaterno'];
    }
    else
    {
      $llen = false;
    }

    if(isset($_POST['correoElec']) && preg_match('/.+@.+\..+/',$_POST['correoElec']))
    {
      $correo = $_POST['correoElec'];
      $correo = base64_encode($correo);//Pasa el texto a base 64
      $correo = bin2hex ($correo);
    }
    else
    {
      $llen = false;
    }

    if(isset($_POST['contra']) && preg_match('/(?=.*[A-Z])(?=.*[\.,!@#$&*])(?=.*[0-9])(?=.*[a-z]).{10,}/',$_POST['contra']))
    {
      $contraseña = $_POST['contra'];
      $contraseña = $contraseña."EBaTdDtDFDtGZ4uBnqmq3BvANFU2J2";
      $contraseña = hash('sha256', $contraseña);
    }
    else
    {
      $llen = false;
    }

    if(isset($_POST['fnacimi']))
    {
      $cumple = $_POST['fnacimi'];
    }

    if(isset($_POST['ntrabajador']) && preg_match('/\d{10}/',$_POST['ntrabajador']))
    {
      $ntrabajador = $_POST['ntrabajador'];
      $ntrabajador = base64_encode($ntrabajador);//Pasa el texto a base 64
      $ntrabajador = bin2hex ($ntrabajador);
    }
    if(isset($_POST['ncuenta']) && preg_match('/^3(18|19|20)\d{6}/',$_POST['ncuenta']))
    {
      $cuenta = $_POST['ncuenta'];
      $tipo = 2;
      $cuenta = base64_encode($cuenta);//Pasa el texto a base 64
      $cuenta = bin2hex ($cuenta);
      $ntrabajador = "NA";
    }
    else if(isset($_POST['rfc']) && preg_match('/[A-Z]{4}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])([0-9]|[A-Z]){3}/',$_POST['rfc']))
    {
      $cuenta = $_POST['rfc'];
      $cuenta = base64_encode($cuenta);//Pasa el texto a base 64
      $cuenta = bin2hex ($cuenta);
      $tipo = 1;
      $cumple = "NA";
    }
    else
    {
      $llen = false;
    }
    if ($llen)
    {
      mysqli_real_escape_string ($conexion, $nombre);
      mysqli_real_escape_string ($conexion, $aP);
      mysqli_real_escape_string ($conexion, $aM);
      mysqli_real_escape_string ($conexion, $correo);
      mysqli_real_escape_string ($conexion, $contraseña);
      mysqli_real_escape_string ($conexion, $cumple);
      mysqli_real_escape_string ($conexion, $ntrabajador);
      mysqli_real_escape_string ($conexion, $cuenta);
      $img = "../../statics/img/perfiles/perfil.jpg";
      $reg = "INSERT INTO usuario (id_usuario,numeroTrabajador,Nombre,ApellidoP,ApellidoM,Tipo,Correo,Contrasena,Cumple,img) VALUES(\"$cuenta\",\"$ntrabajador\",\"$nombre\",\"$aP\",\"$aM\",\"$tipo\",\"$correo\",\"$contraseña\",\"$cumple\",\"$img\")";
      mysqli_query($conexion, $reg);
      header('Location: ../../index.html');
    }
    else
    {
      echo "Datos inválidos o vacíos <br><br>
            <a href='../../templates/registro.html'>Regresar</a>";
    }
  }
  echo '</div>
      </body>
    </html>';
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
