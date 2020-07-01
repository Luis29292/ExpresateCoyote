<?php
  //Aquí el alumno o profesor puede cambia su foto de perfil, dónde con validamos el tipo de archivo seleccionado
  echo '<!DOCTYPE html>
        <html lang="en" dir="ltr">
          <head>
            <link rel="stylesheet" href="../../statics/css/configuracion.css">
            <link rel="icon" href="../../statics/img/logo.jpg">
            <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
            <meta charset="utf-8">
            <title>CoyoExpresate: Nueva Foto</title>
          </head>
          <body>
          <div class="img">
            <img src="../../statics/img/tuerca.png">
          </div>
          <div class="config">
            <form action="nuevafoto.php" method="POST" accept="image/*" enctype="multipart/form-data">
              Subir una nueva foto de perfil<br><br>
              <input type="file" name="fotoPerfil">
              <br><br>
              <input type="submit" name="Enviar">
            </form>';
  include "./conexion.php";
  if ($conexion)
  {
    session_name("usuario");
    session_start();

    $usu = $_SESSION['usu'];
    $usB = $_SESSION['usu'];
    $consulta = "SELECT id_usuario FROM usuario WHERE correo LIKE \"$usu\" OR id_usuario LIKE \"$usu\"";
    $respuesta = mysqli_query($conexion,$consulta);
    $row= mysqli_fetch_array($respuesta);
    $usu=$row[0];
    $usu = base64_decode(hex2bin($usu));
    $exi = (isset($_FILES['fotoPerfil']['type'])) ? $_FILES['fotoPerfil']['type']:"";
    $exi = str_replace("/",".",$exi);//Cambia la diagonal del string, por un punto
    $exi = str_replace("image","",$exi);

    if (isset($_FILES['fotoPerfil']))
    {
      //Obtiene el nombre del archivo enviado
      $file_type = $_FILES['fotoPerfil']['type'];

      //Obtiene el tipo de archivo enviado enviado
      $file_info = $_FILES['fotoPerfil']['tmp_name'];

      //Obtiene la ubicación temporal del archivo
      $file_store = "../../statics/img/perfiles/".$usu.rand(1,100).$exi;

      //Da una ruta de almacenamiento
      if ($file_type = "jpg"||"jpeg"||"png")
      {
        //El formato es correcto
        if (file_exists($file_store))
        {
          //El archivo ya fue enviado
          echo "<br>La imagen ha sido cambiada<br><br><br>";
          $Nimg = "UPDATE usuario SET img = \"$file_store\" WHERE id_usuario LIKE \"$usB\" OR Correo LIKE \"$usB\"";
          mysqli_query($conexion, $Nimg);
          echo "<a href='perfil.php'>Regresar a mi perfil</a>";
        }
        else
        {
          if (move_uploaded_file($file_info, $file_store))
          {
            echo "<br>La imagen ha sido cambiada<br><br><br>";
            $Nimg = "UPDATE usuario SET img = \"$file_store\" WHERE id_usuario LIKE \"$usB\" OR Correo LIKE \"$usB\"";
            mysqli_query($conexion, $Nimg);
            echo "<a href='perfil.php'>Regresar a mi perfil</a>";
          }
        }
      }
      else
      {
        echo "El formato no es correcto";
      }
    }
    else
    {
    echo "<br>No se ha subido ninguna imagen";
    }
  }
  echo '</div>
      </body>
    </html>';
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
 ?>
