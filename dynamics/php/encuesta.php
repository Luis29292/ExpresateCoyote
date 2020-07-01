<?php
  include "./conexion.php";
  if ($conexion)
  {
    session_name("usuario");
    session_start();

    /*Obtención de los datos que fomrarán parte de la encuesta, como se mandaron en JSON, se deben desjsonear*/
    $llegada1 = json_decode($_GET["preguntas"]);
    $llegada1 = mysqli_real_escape_string ($conexion , $llegada1);

    $llegada2 = json_decode(strip_tags($_GET["opciones"]));
    $llegada2 = mysqli_real_escape_string ($conexion , $llegada2);

    $titulo = strip_tags($_GET["titulo"]);
    $titulo = mysqli_real_escape_string ($conexion , $titulo );

    $descripcion = strip_tags($_GET["descripcion"]);
    $descripcion=mysqli_real_escape_string ($conexion , $descripcion);

    $categoria = strip_tags($_GET["categoria"]);
    $categoria=mysqli_real_escape_string ($conexion , $categoria);
    $categoria = (int)$categoria;

    $invitados = strip_tags($_GET['invitados']);
    $invitados=mysqli_real_escape_string ($conexion , $invitados);
    $invitados = json_decode($invitados);

    if (count($invitados) == 0)
    {
      $consultaUsuarios = "SELECT id_usuario FROM usuario";
      $respuestaUsuarios = mysqli_query($conexion, $consultaUsuarios);
      while($usuarios = mysqli_fetch_array($respuestaUsuarios, MYSQLI_ASSOC))
      {
        array_push($invitados, $usuarios['id_usuario']);
      }
    }

    $preguntas = $llegada1;
    $opciones = $llegada2;

    $json = json_encode($invitados);
    $orden = 1;
    $noPregunta = 0;
    $creador = $_SESSION['usu'];

    /*Creación del registro de la nueva encuesta.*/
    $newEncuesta = "INSERT INTO ENCUESTA(creador,Invitados,Titulo,Descripcion,id_categoria) VALUES('$creador','$json','$titulo','$descripcion',$categoria)";
    mysqli_query($conexion, $newEncuesta);

    /*Se obtiene la encuesta que se acaba de realizar para poder insertar las preguntas del usuario*/
    $consultaID = "SELECT id_encuesta FROM Encuesta ORDER BY id_encuesta DESC LIMIT 1";
    $respuesta = mysqli_query($conexion,$consultaID);
    $id = mysqli_fetch_array($respuesta,MYSQLI_ASSOC);
    $cadenaIdEncuesta = $id["id_encuesta"];
    $idEncuesta = (int)$cadenaIdEncuesta;

    /*Se recorre el arreglo de las preguntas para que cada una tenga su lugar en  el registro de la encuesta*/
    foreach ($preguntas as $key => $value)
    {
      if ($value != "NULL")
      {
        $noPregunta++;
        $entradaPregunta = "INSERT INTO Pregunta(Pregunta,id_encuesta) VALUES('$value',$idEncuesta)";
        mysqli_query($conexion,$entradaPregunta);

        $consultaPregunta = "SELECT id_pregunta FROM Pregunta ORDER BY id_pregunta DESC LIMIT 1";
        $respuestaPregunta = mysqli_query($conexion, $consultaPregunta);
        $idcadenaPregunta = mysqli_fetch_array($respuestaPregunta, MYSQLI_ASSOC);
        $idPreguntaArreglo = $idcadenaPregunta["id_pregunta"];
        $idPregunta = (int)$idPreguntaArreglo;

        if ($noPregunta == 1)
        {
          $actual = "UPDATE Encuesta SET Pregunta1 = $idPregunta WHERE id_encuesta = $idEncuesta";
          mysqli_query($conexion, $actual);
        }
        elseif ($noPregunta == 2)
        {
          $actual = "UPDATE Encuesta SET Pregunta2 = $idPregunta WHERE id_encuesta = $idEncuesta";
          mysqli_query($conexion, $actual);
        }
        elseif ($noPregunta == 3)
        {
          $actual = "UPDATE Encuesta SET Pregunta3 = $idPregunta WHERE id_encuesta = $idEncuesta";
          mysqli_query($conexion, $actual);
        }
        elseif ($noPregunta == 4)
        {
          $actual = "UPDATE Encuesta SET Pregunta4 = $idPregunta WHERE id_encuesta = $idEncuesta";
          mysqli_query($conexion, $actual);
        }
        elseif ($noPregunta == 5)
        {
          $actual = "UPDATE Encuesta SET Pregunta5 = $idPregunta WHERE id_encuesta = $idEncuesta";
          mysqli_query($conexion, $actual);
        }
        /*A la pregunta en cuestión se le agregarán sus respectivas opciones en la tabla OPCIONES, reconociéndolas con el id_pregunta*/
        foreach ($opciones[$key] as $llave => $valor)
        {
          strip_tags($valor);
          $entradaOpciones = "INSERT INTO Opcion(id_pregunta,orden,contenido,cantidad) VALUES($idPregunta,$orden,'$valor',0)";
          mysqli_query($conexion, $entradaOpciones);
          $orden++;
        }
        $orden = 1;
      }
    }
    $noPregunta = 0;
  }
  mysqli_close($conexion); //Aquí cerramos la conexión con la base de datos
 ?>
