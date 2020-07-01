<?php
  /*Programa que se encarga de una consulta hecha por un fech, según lo que el usuario haya elegido (Contestar encuesta, consultar Encuestas, o ver sus encuestas),
  se le enviarán las encuestas que cumplen con las características solicitas por el botón que oprimió.*/
  include "./conexion.php";
  if ($conexion)
  {
    session_name("usuario");
    session_start();
    $solicitud = strip_tags($_GET["consulta"]);
    $solicitud = (int)$solicitud;
    $llegadaUsu = $_SESSION['usu'];
    $usuario = $llegadaUsu;
    $idPreguntas = [];
    $parciales = [];
    $paqueteFinal = [];
    $consulta = "SELECT * FROM ENCUESTA";
    $respuesta = mysqli_query($conexion, $consulta);
    while ($encuestas = mysqli_fetch_array($respuesta, MYSQLI_ASSOC))
    {
      $invitados = $encuestas["Invitados"];
      $invitados = json_decode($invitados);
      $hecho = $encuestas["Hecho"];
      $hecho = json_decode($hecho);


      /*Caso en el que quiera contestar encuestas, se envian las encuestas en las que está invitado.*/
      if ($solicitud == 1 && $encuestas["creador"]!=$usuario)
      {
        foreach ($invitados as $key => $value)
        {
          if ($value == $usuario)
          {
            $noEncuestaConsultar = $encuestas['id_encuesta'];
            $noEncuestaConsultar = (int)$noEncuestaConsultar;

            $consultaCategoria = "SELECT Categoria FROM CATEGORIA NATURAL JOIN ENCUESTA WHERE id_encuesta = $noEncuestaConsultar";
            $respuestaCategoria = mysqli_query($conexion, $consultaCategoria);
            $arregloCategoria = mysqli_fetch_array($respuestaCategoria, MYSQLI_ASSOC);

            $categoria = $arregloCategoria["Categoria"];
            $credorBase = $encuestas["creador"];
            $consultaHex = "SELECT Nombre FROM USUARIO NATURAL JOIN ENCUESTA WHERE id_usuario LIKE \"$credorBase\" && creador LIKE \"$credorBase\"";
            $respuestaHex = mysqli_query($conexion, $consultaHex);
            $nombreArreglo = mysqli_fetch_array($respuestaHex, MYSQLI_ASSOC);

            $creadorEnc = $nombreArreglo["Nombre"];
            $creador = base64_decode(hex2bin($creadorEnc));
            array_push($parciales,$encuestas["id_encuesta"],$creador,$encuestas["Descripcion"],$encuestas["Titulo"],$categoria);
            array_push($paqueteFinal,$parciales);
            $parciales = [];
          }
        }
      }

      /*Caso en el que quiera consultar encuestas, se envian las encuestas en las que está hecho*/
      if ($solicitud == 2)
      {
        foreach ($hecho as $key => $value)
        {
          if ($value == $usuario)
          {
            $creador = base64_decode(hex2bin($encuestas[""]));
            array_push($parciales,$encuestas["id_encuesta"],$creador,$encuestas["Titulo"],$encuestas["Descripcion"]);
            array_push($paqueteFinal, $parciales);
            $parciales = [];
          }
        }
      }

      /*Caso en el que quiera consultar sus propias encuestas, se envian las encuestas en las que él es el creador.*/
      if ($solicitud == 3)
      {
        if ($encuestas["creador"] == $usuario)
        {
          array_push($parciales,$encuestas["id_encuesta"],$encuestas["Titulo"],$encuestas["Descripcion"]);
          array_push($paqueteFinal,$parciales);
          $parciales = [];
        }
      }
    }
    $paqueteFinal = json_encode($paqueteFinal);
    echo $paqueteFinal;
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
