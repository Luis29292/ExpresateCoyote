<?php
  /*Programa encargado de mandar al fetch de JS todos los usuarios de la base, para que en caso de que el usuario pueda
  seleccionar a las personas que verán la encuesta, pueda visualizar correctamente las opciones.*/
  include "./conexion.php";
  if ($conexion)
  {
    $usuariosSistema = [];
    $parciales = [];

    /*Se manda su nombre y su id.*/
    $GET['consulta']=strip_tags($GET['consulta']);
    if ($_GET['consulta'] == 1)
    {
      $usuarios = "SELECT * FROM USUARIO";
      $respuestaUs = mysqli_query($conexion, $usuarios);
      while ($nombre = mysqli_fetch_array($respuestaUs, MYSQLI_ASSOC))
      {
        $idUsu = $nombre['id_usuario'];
        $invitado = base64_decode(hex2bin($nombre['Nombre']))." ".$nombre['ApellidoP']." ".$nombre['ApellidoM'];
        array_push($parciales,$idUsu, $invitado);
        array_push($usuariosSistema, $parciales);
        $parciales = [];
      }
      $usuariosSistema = json_encode($usuariosSistema);
      print_r($usuariosSistema);
    }

    /*Se manda su nombre únicamente*/
    if ($_GET['consulta'] == 2)
    {
      $nombreASaber = $_GET['usuario'];
      $nombreASaber = mysqli_real_escape_string ($conexion, $nombreASaber);
      $consultaNombre = "SELECT * FROM USUARIO WHERE id_usuario = '$nombreASaber'";
      $respuestaNombre = mysqli_query($conexion, $consultaNombre);
      $nombreCompleto = mysqli_fetch_array($respuestaNombre, MYSQLI_ASSOC);
      $nombreAMandar = base64_decode(hex2bin($nombreCompleto['Nombre']))." ".$nombreCompleto['ApellidoP']." ".$nombreCompleto['ApellidoM'];
      echo $nombreAMandar;
    }
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
 ?>
