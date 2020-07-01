<?php
  include "./conexion.php";
  if ($conexion)
  {
    /*Archivo encargado de levantar una sanción en la encuesta resportada, como también quitar de invitados al usuario que hizo la denuncia.*/
    session_name("usuario");
    session_start();

    $usuario = $_SESSION['usu'];
    $noencuesta = strip_tags($_GET["encuesta"]);
    $noencuesta = mysqli_real_escape_string ($conexion, $noencuesta);

    $consultaSanciones = "SELECT Denuncias FROM ENCUESTA WHERE id_encuesta = $noencuesta";
    $respuestaSanciones = mysqli_query($conexion, $consultaSanciones);
    $sancionesArreglo = mysqli_fetch_array($respuestaSanciones, MYSQLI_ASSOC);

    $noSanciones = $sancionesArreglo ["Denuncias"];
    $actualizarSancion = $noSanciones + 1;
    $actualizarSancion = (int)$actualizarSancion;
    
    $aumentoSancion = "UPDATE ENCUESTA SET Denuncias = $actualizarSancion WHERE id_encuesta = $noencuesta";
    mysqli_query($conexion, $aumentoSancion);

    $invitados = "SELECT Invitados FROM ENCUESTA WHERE id_encuesta = $noencuesta";
    $peticion = mysqli_query($conexion, $invitados);
    $devuelta = mysqli_fetch_array($peticion, MYSQLI_ASSOC);
    $arregloInvitados = $devuelta["Invitados"];
    $arregloInvitados = json_decode($arregloInvitados);

    $hechos = "SELECT Hecho FROM ENCUESTA WHERE id_encuesta = $noencuesta";
    $peticion2 = mysqli_query($conexion, $hechos);
    $devuelta2 = mysqli_fetch_array($peticion2, MYSQLI_ASSOC);
    $arregloHechos = $devuelta2["Hecho"];
    $arregloHechos = json_decode($arregloHechos);

    if(!isset($arregloHechos))
    {
      $arregloHechos = [];
    }

    foreach ($arregloInvitados as $key => $value)
    {
      if ($value == $usuario)
      {
        unset($arregloInvitados[$key]);
      }
    }
    $arregloInvitados = array_values($arregloInvitados);
    $arregloHechos = json_encode($arregloHechos);
    $arregloInvitados = json_encode($arregloInvitados);

    $noencuesta = (int)$noencuesta;

    $actualizacionHechos = "UPDATE ENCUESTA SET Hecho = '$arregloHechos' WHERE id_encuesta = $noencuesta";
    mysqli_query($conexion, $actualizacionHechos);
    $actualizacionInvitados = "UPDATE ENCUESTA SET Invitados = '$arregloInvitados' WHERE id_encuesta = $noencuesta";
    mysqli_query($conexion, $actualizacionInvitados);
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
