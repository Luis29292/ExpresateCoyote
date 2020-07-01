<?php
  //Aquí le desplegamos al administrador una tabla con los usuarios registrados en la base de datos y los botones con las dos acciones que puede ejercer en ellos
  echo '<!DOCTYPE html>
          <html lang="en" dir="ltr">
            <head>
              <link rel="stylesheet" href="../../statics/css/adminUsuarios.css">
              <link rel="icon" href="../../statics/img/logo.jpg">
              <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
              <meta charset="utf-8">
              <title>CoyoExpresate: Usuarios</title>
            </head>
            <body>';
    include './conexion.php';
    if ($conexion)
    {
      $consulta = "SELECT * FROM usuario";
      $respuesta = mysqli_query($conexion, $consulta);
      echo "<table>
              <tr>
                <th>ID usuario</th>
                <th class='tel'>Apellido Paterno</th>
                <th class='tel'>Apellido Materno</th>
                <th class='tel'>Tipo de usuario</th>
                <th class='tel'>Cumpleaños</th>
              </tr>";
      while ($row = mysqli_fetch_array($respuesta)) //Nos muestra los usuarios
      {
        echo "<tr>
                <td>".$row[0]."</td>
                <td class='tel'>".$row[3]."</td>
                <td class='tel'>".$row[4]."</td>
                <td class='tel'>".$row[5]."</td>
                <td class='tel'>".$row[8]."</td>
              </tr>";
      }
      echo '</table><br><br>
            <a href="perfil.php">Regresar</a>
            <button type="button" id="bloqUsu" name="bloquear">Bloquear Usuario</button>
            <button type="button" id="elimUsu" name="eliminar">Eliminar Usuario</button><br><br>
            <div id="adminUsuarios"></div>
            <script src="../../libs/JQuery/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="../js/adminUsuarios.js"></script>';
    }
    echo "</body>
        </html>";
    mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
