<?php
  /*Archivo encargado de eliminar la encuesta de la tabla Encuesta, sus respectivas preguntas como también las opciones de las preguntas.*/
  include "./conexion.php";
  if ($conexion)
  {
    $encuesta=strip_tags($_GET["encuesta"]);
    $encuesta=mysqli_real_escape_string ($conexion,$encuesta);
    $totalPreguntas = [];
    $encuesta = (int)$encuesta;

    //Pregunta1
    $consultaPregunta = "SELECT Pregunta1 FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $respuesta = mysqli_query($conexion, $consultaPregunta);
    $preguntaArreglo = mysqli_fetch_array($respuesta, MYSQLI_ASSOC);
    $pregunta = $preguntaArreglo["Pregunta1"];
    if(isset($pregunta))
    {
      $pregunta = (int)$pregunta;

      $borraropcion = "DELETE FROM OPCION WHERE id_pregunta = $pregunta";
      mysqli_query($conexion, $borraropcion);
      array_push($totalPreguntas, $pregunta);
    }

    //Pregunta 2
    $consultaPregunta = "SELECT Pregunta2 FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $respuesta = mysqli_query($conexion, $consultaPregunta);
    $preguntaArreglo = mysqli_fetch_array($respuesta, MYSQLI_ASSOC);
    $pregunta = $preguntaArreglo["Pregunta2"];
    if(isset($pregunta))
    {
      $pregunta = (int)$pregunta;

      $borraropcion = "DELETE FROM OPCION WHERE id_pregunta = $pregunta";
      mysqli_query($conexion, $borraropcion);
      array_push($totalPreguntas, $pregunta);
    }

    //Pregunta3
    $consultaPregunta = "SELECT Pregunta3 FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $respuesta = mysqli_query($conexion, $consultaPregunta);
    $preguntaArreglo = mysqli_fetch_array($respuesta, MYSQLI_ASSOC);
    $pregunta = $preguntaArreglo["Pregunta3"];
    if(isset($pregunta))
    {
      $pregunta = (int)$pregunta;

      $borraropcion = "DELETE FROM OPCION WHERE id_pregunta = $pregunta";
      mysqli_query($conexion, $borraropcion);
      array_push($totalPreguntas, $pregunta);
    }

    //Pregunta4
    $consultaPregunta = "SELECT Pregunta4 FROM ENCUESTA WHERE id_encuesta = $encuesta";
    $respuesta = mysqli_query($conexion, $consultaPregunta);
    $preguntaArreglo = mysqli_fetch_array($respuesta, MYSQLI_ASSOC);
    $pregunta = $preguntaArreglo["Pregunta4"];
    if(isset($pregunta))
    {
      $pregunta = (int)$pregunta;

      $borraropcion = "DELETE FROM OPCION WHERE id_pregunta = $pregunta";
      mysqli_query($conexion, $borraropcion);
      array_push($totalPreguntas, $pregunta);
    }

    //Pregunta5
    $consultaPregunta = "SELECT Pregunta5 FROM ENCUESTA WHERE  id_encuesta = $encuesta";
    $respuesta = mysqli_query($conexion, $consultaPregunta);
    $preguntaArreglo = mysqli_fetch_array($respuesta, MYSQLI_ASSOC);
    $pregunta = $preguntaArreglo["Pregunta5"];
    if(isset($pregunta))
    {
      $pregunta = (int)$pregunta;

      $borraropcion = "DELETE FROM OPCION WHERE id_pregunta = $pregunta";
      mysqli_query($conexion, $borraropcion);
      array_push($totalPreguntas, $pregunta);
    }
    $eliminarEncuesta = "DELETE FROM ENCUESTA WHERE id_encuesta=$encuesta";
    mysqli_query($conexion, $eliminarEncuesta);

    foreach ($totalPreguntas as $key => $value)
    {
      $value = (int)$value;
      $deletePregunta = "DELETE FROM PREGUNTA WHERE id_pregunta = $value";
      mysqli_query($conexion, $deletePregunta);
    }
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
?>
