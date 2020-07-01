<?php
  /*Programa encargado de actualizar en la base de datos los datos introducidos por el usuario. También realiza el cambio de
  peronas que no hacen la encuestas a la lista de personas que ya la hicieron.*/
  include "./conexion.php";
  if ($conexion)
  {
    if(isset($_GET["variable1"]))
    {
      $respuesta1 = strip_tags($_GET["variable1"]);
      $respuesta1 = mysqli_real_escape_string ($conexion, $respuesta1);
      $respuesta1 = (int)$respuesta1;

      $valor = strip_tags($_GET["1"]);
      $valor = mysqli_real_escape_string ($conexion, $valor);
      $valor = (int)$valor;

      $consultaCantidad = "SELECT cantidad FROM Pregunta NATURAL JOIN Opcion WHERE id_pregunta = $respuesta1 && orden = $valor";
      $consultaCant = mysqli_query($conexion, $consultaCantidad);
      $cantidadArreglo = mysqli_fetch_array($consultaCant, MYSQLI_ASSOC);

      $cantidad = $cantidadArreglo["cantidad"];
      $cantidad = (int)$cantidad;
      $cantidad++;

      $actualizacionCampo1 = "UPDATE OPCION SET cantidad = $cantidad WHERE id_pregunta = $respuesta1 && orden = $valor";
      mysqli_query($conexion, $actualizacionCampo1);
    }

    if(isset($_GET["variable2"]))
    {
      $respuesta1 = strip_tags($_GET["variable2"]);
      $respuesta1 = mysqli_real_escape_string ($conexion, $respuesta1);
      $respuesta1 = (int)$respuesta1;

      $valor = strip_tags($_GET["2"]);
      $valor = mysqli_real_escape_string ($conexion, $valor);
      $valor = (int)$valor;

      $consultaCantidad = "SELECT cantidad FROM Pregunta NATURAL JOIN Opcion WHERE id_pregunta= $respuesta1 && orden = $valor";
      $consultaCant = mysqli_query($conexion, $consultaCantidad);
      $cantidadArreglo = mysqli_fetch_array($consultaCant, MYSQLI_ASSOC);

      $cantidad = $cantidadArreglo["cantidad"];
      $cantidad = (int)$cantidad;
      $cantidad++;

      $actualizacionCampo1 = "UPDATE OPCION SET cantidad = $cantidad WHERE id_pregunta = $respuesta1 && orden = $valor";
      mysqli_query($conexion, $actualizacionCampo1);
    }

    if(isset($_GET["variable3"]))
    {
      $respuesta1 = strip_tags($_GET["variable3"]);
      $respuesta1 = mysqli_real_escape_string ($conexion, $respuesta1);
      $respuesta1 = (int)$respuesta1;

      $valor = strip_tags($_GET["3"]);
      $valor = mysqli_real_escape_string ($conexion, $valor);
      $valor = (int)$valor;

      $consultaCantidad = "SELECT cantidad FROM Pregunta NATURAL JOIN Opcion WHERE id_pregunta = $respuesta1 && orden = $valor";
      $consultaCant = mysqli_query($conexion, $consultaCantidad);
      $cantidadArreglo = mysqli_fetch_array($consultaCant, MYSQLI_ASSOC);

      $cantidad = $cantidadArreglo["cantidad"];
      $cantidad = (int)$cantidad;
      $cantidad++;

      $actualizacionCampo1 = "UPDATE OPCION SET cantidad = $cantidad WHERE id_pregunta = $respuesta1 && orden = $valor";
      mysqli_query($conexion,$actualizacionCampo1);
    }

    if(isset($_GET["variable4"]))
    {
      $respuesta1 = strip_tags($_GET["variable4"]);
      $respuesta1 = mysqli_real_escape_string ($conexion, $respuesta1);
      $respuesta1 = (int)$respuesta1;

      $valor = strip_tags($_GET["4"]);
      $valor = mysqli_real_escape_string ($conexion, $valor);
      $valor = (int)$valor;

      $consultaCantidad = "SELECT cantidad FROM Pregunta NATURAL JOIN Opcion WHERE id_pregunta= $respuesta1 && orden = $valor";
      $consultaCant = mysqli_query($conexion,$consultaCantidad);
      $cantidadArreglo = mysqli_fetch_array($consultaCant,MYSQLI_ASSOC);
      $cantidad = $cantidadArreglo["cantidad"];
      $cantidad = (int)$cantidad;
      $cantidad++;

      $actualizacionCampo1 = "UPDATE OPCION SET cantidad = $cantidad WHERE id_pregunta= $respuesta1 && orden = $valor";
      mysqli_query($conexion,$actualizacionCampo1);
    }

    if(isset($_GET["variable5"]))
    {
      $respuesta1 = strip_tags($_GET["variable5"]);
      $respuesta1 = mysqli_real_escape_string ($conexion, $respuesta1);
      $respuesta1 = (int)$respuesta1;

      $valor = strip_tags($_GET["5"]);
      $valor = mysqli_real_escape_string ($conexion, $valor);
      $valor = (int)$valor;

      $consultaCantidad = "SELECT cantidad FROM Pregunta NATURAL JOIN Opcion WHERE id_pregunta = $respuesta1 && orden = $valor";
      $consultaCant = mysqli_query($conexion, $consultaCantidad);
      $cantidadArreglo = mysqli_fetch_array($consultaCant, MYSQLI_ASSOC);

      $cantidad = $cantidadArreglo["cantidad"];
      $cantidad = (int)$cantidad;
      $cantidad++;

      $actualizacionCampo1 = "UPDATE OPCION SET cantidad = $cantidad WHERE id_pregunta = $respuesta1 && orden = $valor";
      mysqli_query($conexion, $actualizacionCampo1);
    }

    $realizado = strip_tags($_GET["usuario"]);
    $realizado = mysqli_real_escape_string ($conexion, $realizado);
    $noEncuesta = strip_tags($_GET["encuesta"]);
    $noEncuesta = mysqli_real_escape_string ($conexion, $noEncuesta);

    $invitados = "SELECT Invitados FROM ENCUESTA WHERE id_encuesta = $noEncuesta";
    $peticion = mysqli_query($conexion, $invitados);
    $devuelta = mysqli_fetch_array($peticion, MYSQLI_ASSOC);
    $arregloInvitados = $devuelta["Invitados"];
    $arregloInvitados = json_decode($arregloInvitados);

    $hechos = "SELECT Hecho FROM ENCUESTA WHERE id_encuesta = $noEncuesta";
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
      if ($value == $realizado)
      {
        array_push($arregloHechos, $value);
        unset($arregloInvitados[$key]);
      }
    }
    $arregloInvitados = array_values($arregloInvitados);
    $arregloHechos = json_encode($arregloHechos);
    $arregloInvitados = json_encode($arregloInvitados);

    $noEncuesta = (int)$noEncuesta;

    $actualizacionHechos = "UPDATE ENCUESTA SET Hecho = '$arregloHechos' WHERE id_encuesta = $noEncuesta";
    mysqli_query($conexion, $actualizacionHechos);
    $actualizacionInvitados = "UPDATE ENCUESTA SET Invitados = '$arregloInvitados' WHERE id_encuesta = $noEncuesta";
    mysqli_query($conexion, $actualizacionInvitados);

    header("Location: ../../templates/respuestaExitosa.html");
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
