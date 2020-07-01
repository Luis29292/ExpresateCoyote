<?php
  //Aquí creamos la conexión con la base de datos
  $conexion = mysqli_connect("localhost","AdminCE","C0y03xpr354t3.","baseCE");
  if (!$conexion) //Si la conexion falla, mandamos a pantalla el siguiente texto y y las funciones mysqli_connect_error() y mysqli_connect_errno()
  {
    echo "Failed to connect to MySQL <br>";
    echo mysqli_connect_error();
    echo mysqli_connect_errno();
    exit();
  }
?>
