<?php
  echo '<!DOCTYPE html>
          <html lang="en" dir="ltr">
            <head>
              <link rel="stylesheet" href="../../statics/css/principalEncuestas.css">
              <link rel="icon" href="../../statics/img/logo.jpg">
              <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
              <meta charset="utf-8">
              <title>CoyoExpresate: Encuestas</title>
            </head>
            <body>';
  /*Archivo encargado de imprimir ya sea la encuesta como tal o la consulta(en caso de que el usuario ya la haya contestado)*/
  include "./conexion.php";
  if ($conexion)
  {
    session_name("usuario");
    session_start();
    $llegadaUsuario = $_SESSION['usu'];
    $usuario = $llegadaUsuario;
    $contador = 0;
    $numeroPregunta = 1;
    $valid = false;
    $resultados = false;
    $validCreador = false;
    $encuesta = strip_tags($_GET["encuesta"]);
    $encuesta=mysqli_real_escape_string ($conexion, $encuesta);

    /*Se verifica según la encuesta que el usuario haya elegido. Dentro de esa encuesta se verifica si ya la contestó o no, esto basándose en la existencia de su id en invitados y hechos.*/
    $invitados = "SELECT Invitados FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $peticion = mysqli_query($conexion, $invitados);
    $devuelta = mysqli_fetch_array($peticion, MYSQLI_ASSOC);
    $arregloInvitados = $devuelta["Invitados"];
    $arregloInvitados = json_decode($arregloInvitados);

    $hechos = "SELECT Hecho FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $peticionHecho = mysqli_query($conexion, $hechos);

    foreach ($arregloInvitados as $key => $value)
    {
      if ($value == $usuario)
      {
        $valid = true;
      }
    }
    $hechos = "SELECT Hecho FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $peticionHecho = mysqli_query($conexion, $hechos);
    $arregloHechos = mysqli_fetch_array($peticionHecho, MYSQLI_ASSOC);
    $personasRealizadas = $arregloHechos["Hecho"];
    $personasOficiales = json_decode($personasRealizadas);

    foreach ($personasOficiales as $key => $value2)
    {
      if ($value2 == $usuario)
      {
        $resultados = true;
      }
    }
    $consultaCreador = "SELECT creador FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $respuestaCreador = mysqli_query($conexion, $consultaCreador);
    $arregloCreador = mysqli_fetch_array($respuestaCreador, MYSQLI_ASSOC);
    $creador = $arregloCreador["creador"];

    if ($usuario == $creador)
    {
      $validCreador = true;
    }

    /*En caso de que haya aparecido en la lista de los que aún no hacen la encuesta, se le imprimirá la pregunta como formulario, se mandan inputs escondidos con informacion de la pregunta y la opcion que se seleccionó*/
    if ($valid == true && $validCreador == false)
    {
      echo "<form method='get' action='../dynamics/php/recibo.php'>";
      $consulta = "SELECT * FROM PREGUNTA NATURAL JOIN ENCUESTA WHERE id_encuesta = $encuesta";
      $respuesta = mysqli_query($conexion,$consulta);
      while($inf_pedidos = mysqli_fetch_array($respuesta, MYSQLI_ASSOC))
      {
        $contador++;
        $i = $inf_pedidos["id_pregunta"];
        echo "<h1 id='encabezado'>".$numeroPregunta.".- ".$inf_pedidos["Pregunta"]."</h1><br>";
        $segundo = "SELECT * FROM PREGUNTA NATURAL JOIN OPCION WHERE id_pregunta = $i";
        $respuesta2= mysqli_query($conexion, $segundo);
        while($dos = mysqli_fetch_array($respuesta2, MYSQLI_ASSOC))
        {
          echo "<input type='radio' name='".$contador."' value='".$dos["orden"]."' required><span class='opcion'>  ".$dos["contenido"]."</span><br>";
          echo '<input type="hidden" name="variable'.$contador.'" value="'.$dos["id_pregunta"].'"><br>';
          echo '<input type="hidden" name="usuario" value="'.$usuario.'">';
          echo '<input type="hidden" name="encuesta" value="'.$encuesta.'">';
          echo "<br>";
        }
        $numeroPregunta++;
      }
      echo '<input type="submit" value="Enviar" class="btn btn-success" id="enviar"><br><br>
          </form>';
    }

    /*En caso de que haya aparecido en la lista de las personas que ya hizo la encuesta se imprimirán en forma de tabla las opciones y la frecuencia de las opciones.*/
    if ($resultados == true || $validCreador == true)
    {
      $consulta = "SELECT * FROM PREGUNTA NATURAL JOIN ENCUESTA WHERE id_encuesta = $encuesta";
      $respuesta= mysqli_query($conexion, $consulta);
      while($inf_pedidos = mysqli_fetch_array($respuesta, MYSQLI_ASSOC))
      {
        $contador++;
        $i = $inf_pedidos["id_pregunta"];
        echo "<h1>Pregunta ".$numeroPregunta.": ".$inf_pedidos["Pregunta"]."</h1><br>";
        echo "<table>
                <tr>
                  <th>Opción</th>
                  <th>Frecuencia</th>
                </tr>";
        $segundo = "SELECT * FROM PREGUNTA NATURAL JOIN OPCION WHERE id_pregunta = $i";
        $respuesta2 = mysqli_query($conexion,$segundo);
        while($dos = mysqli_fetch_array($respuesta2, MYSQLI_ASSOC))
        {
          echo "<tr>
                  <td>".$dos["contenido"]."</td>
                  <td>".$dos["cantidad"]."</td>
                </tr>";
        }
        echo "</table>
              <br>";
        $numeroPregunta++;
      }
    }
  }
  echo "</body>
      </html>";
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
 ?>
