<?php
  //Aquí es dónde se despliega la página con la información del usuario (nombre, correo, fecha de nacimiento...) y los botones para configurar su perfil, ir a encuestas o cerrar sesión
  //Si es un Administrador, le aparece un boton para cuestiones de usuarios
  include "./conexion.php";
  if ($conexion)
  {
    session_name("usuario");
    session_start();
    if (isset($_SESSION['usu']) != "")
    {
      echo "<!DOCTYPE html>
              <html lang='en' dir='ltr'>
                <head>
                  <link rel='stylesheet' href='../../statics/css/perfil.css'>
                  <link rel='icon' href='../../statics/img/logo.jpg'>
                  <meta name='viewport' content='width=device-width,initial-scale=1,shrink-to-fit=no'>
                  <meta charset='utf-8'>
                  <title>CoyoExpresate: Mi perfil</title>
                </head>
                <body>";

      $usu = $_SESSION['usu'];

      $Usuario = "SELECT * FROM usuario WHERE id_usuario LIKE \"$usu\" OR Correo LIKE \"$usu\"";
      $resUsu = mysqli_query($conexion, $Usuario);
      $datos = mysqli_fetch_array($resUsu, MYSQLI_ASSOC);
      $tipo = $datos['Tipo'];
      echo "<div class='informacion'>";

      if ($tipo == 1)
      {
        echo "<h1>Bienvenido <br> Profesor / Profesora</h1>
              <h2>".base64_decode(hex2bin($datos['Nombre']))." ".$datos['ApellidoP']." ".$datos['ApellidoM']."</h2>
              <p>
                Foto de perfil:<br><br>
                <img id='#perfil' src=".$datos['img'].">
              </p>
              <p>Correo eléctronico: ".base64_decode(hex2bin($datos['Correo']))."</p><br>
              </div>
              <a href='../../templates/configuracion.html' id='config'>Configuración</a>
              <div class='botones'>
                <a href='./nuevafoto.php' id='botones'>Cambiar imagen</a>
                <a href='../../templates/principalEncuestas.html'>Encuestas</a>
                <a href='./cerrarS.php'>Cerrar sesión</a>
              </div>";
      }
      if ($tipo == 2)
      {
        echo "<h1>Bienvenido Alumn@</h1>
              <h2>".base64_decode(hex2bin($datos['Nombre']))." ".$datos['ApellidoP']." ".$datos['ApellidoM']."</h2>
              <p>
                Foto de perfil:<br><br>
                <img id='#perfil' src=".$datos['img'].">
              </p>
              <p>Fecha de nacimiento: ".$datos['Cumple']."</p>
              <p>Correo eléctronico: ".base64_decode(hex2bin($datos['Correo']))."</p>
              </div>
              <a href='../../templates/configuracion.html' id='config'>Configuración</a>
              <div class='botones'>
                <a href='./nuevafoto.php' id='botones'>Cambiar imagen</a>
                <a href='../../templates/principalEncuestas.html'>Encuestas</a>
                <a href='./cerrarS.php'>Cerrar sesión</a>
              </div>";
      }
      if ($tipo == 3)
      {
        echo "<h1>Bienvenido Admin</h1>
              <h2>".$datos['Nombre']." ".$datos['ApellidoP']." ".$datos['ApellidoM']."</h2>
              <p>
                Foto de perfil:<br><br>
                <img id='imgAdmin' src='../../statics/img/administradores.png'>
              </p>
              <p>Correo eléctronico: ".$datos['Correo']."</p>
              </div>
              <div class='botones'>
                <a href='../../templates/configAdmin.html'>Configuración perfil</a>
                <a href='../../templates/principalEncuestas.html'>Encuestas</a>
                <a href='./adminUsuarios.php'>Usuarios</a>
                <a href='./cerrarS.php'>Cerrar sesión</a>
              </div>";
      }
    }
    else
    {
      header('Location: ../../templates/inicioSesion.html');
    }
  }
  echo '</body>
      </html>';
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
