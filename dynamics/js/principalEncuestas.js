/*Programa encargado de analizar los eventos del navbar, para que con base en esto se puedan desplegar las encuestas correspondientes.*/
let body = document.getElementById("tablas");
let responder = document.getElementById('resp');
let consulta = document.getElementById("consultar");
let misEnc = document.getElementById("misEnc");
let hacerEnc = document.getElementById("hacerEnc");
let perfil = document.getElementById("perfil");
let cSesion = document.getElementById("cSesion");
let denunciar = document.getElementById("denunciar");

/*Evento que despliega las encuestas que el usuario aún no contesta. Se imprime toda la información de la misma con la opciones de denunciar la encuesta o responderla.*/
responder.addEventListener("click", () => {
  $("#tablas").empty();
  $(".modal_creditos").css("display","none");
  $("#carouselExampleSlidesOnly").css("display","none");

  fetch("../dynamics/php/principalEncuestas.php?consulta=1")
  .then((response) => {
    return ret = response.text();
  })
  .then((text) => {
    let preguntas = JSON.parse(text);
    let tabla = document.createElement("table");
    tabla.setAttribute("id", "table");
    body.appendChild(tabla);

    let encabezado1 = document.createElement("th");
    encabezado1.innerText = "Título";
    tabla.appendChild(encabezado1);

    let encabezado2 = document.createElement("th");
    encabezado2.innerText = "Creador";
    tabla.appendChild(encabezado2);

    let encabezado3 = document.createElement("th");
    encabezado3.innerText = "Descripción";
    tabla.appendChild(encabezado3);

    let encabezado4 = document.createElement("th");
    encabezado4.innerText = "Categoría";
    tabla.appendChild(encabezado4);

    let encabezado5 = document.createElement("th");
    encabezado5.innerText = "Contestar";
    tabla.appendChild(encabezado5);

    let encabezado8 = document.createElement("th");
    encabezado8.innerText = "Denunciar";
    tabla.appendChild(encabezado8);

    preguntas.forEach((element) => {
      let row = document.createElement("tr");

      let titulo = document.createElement("td");
      titulo.innerText = element[3];
      row.appendChild(titulo);

      let creador = document.createElement("td");
      creador.innerText = element[1];
      row.appendChild(creador);

      let descripcion = document.createElement("td");
      descripcion.innerText = element[2];
      row.appendChild(descripcion);

      let categoriaEnc = document.createElement("td");
      categoriaEnc.innerText = element[4];
      row.appendChild(categoriaEnc);

      let espacioBoton = document.createElement("td");
      let boton = document.createElement("button");
      boton.innerHTML = '<i class="fas fa-edit"></i>';
      boton.setAttribute("id", element[0]);
      boton.classList.add("aEncuesta");
      espacioBoton.appendChild(boton);
      row.appendChild(espacioBoton);

      let td = document.createElement("td");
      let denunciar = document.createElement("button");
      denunciar.classList.add("denunciar");
      denunciar.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
      denunciar.addEventListener("click", () => {
        fetch("../dynamics/php/sancion.php?encuesta="+element[0])
        .then(() => {
          window.location.reload();
        })
        .catch((error) => {
          console.error(error);
        })
      });
      td.appendChild(denunciar)
      row.appendChild(td);
      tabla.appendChild(row);

      eventBoton = document.getElementById(element[0]);
      eventBoton.addEventListener("click", () => {
        $("#denunciar").css("display","inline");

        fetch("../dynamics/php/actual.php?encuesta="+element[0])
        .then((response) => {
          return contenido = response.text();
        }).then((text) => {
          body.innerHTML = text;
        })
        .catch((error) => {
          console.error(error);
        })
      });
    });
  })
  .catch((error) => {
    console.error(error);
  })
});

/*Evento que despliega las encuestas que el usuario ya contestó, se le da la opción de consultar los resultados de la misma*/
consulta.addEventListener("click", () => {
  $("#tablas").empty();
  $("#carouselExampleSlidesOnly").css("display","none");
  $(".modal_creditos").css("display","none");

  fetch("../dynamics/php/principalEncuestas.php?consulta=2")
  .then((response) => {
    return ret = response.text();
  })
  .then((text) => {
    let preguntas = JSON.parse(text);
    console.log(preguntas);

    let tabla = document.createElement("table");
    tabla.setAttribute("id", "table");
    body.appendChild(tabla);

    let encabezado1 = document.createElement("th");
    encabezado1.innerText = "Título";
    tabla.appendChild(encabezado1);

    let encabezado2 = document.createElement("th");
    encabezado2.innerText = "Descripción";
    tabla.appendChild(encabezado2);

    let encabezado3 = document.createElement("th");
    encabezado3.innerText = "Consultar";
    tabla.appendChild(encabezado3);

    preguntas.forEach((element) => {
      let row = document.createElement("tr");

      let titulo = document.createElement("td");
      titulo.innerText = element[2];
      row.appendChild(titulo);

      let descripcion = document.createElement("td");
      descripcion.innerText = element[3];
      row.appendChild(descripcion);

      let espacioBoton = document.createElement("td");
      let boton = document.createElement("button");
      boton.innerHTML = '<i class="far fa-eye"></i>';
      boton.setAttribute("id", element[0]);
      boton.classList.add("aEncuesta");
      espacioBoton.appendChild(boton);
      row.appendChild(espacioBoton);

      tabla.appendChild(row);
      let eventBoton = document.getElementById(element[0]);
      eventBoton.addEventListener("click", () => {
        fetch("../dynamics/php/actual.php?encuesta="+element[0])
        .then((response) => {
          return contenido = response.text();
        })
        .then((text) => {
          body.innerHTML = text;
        })
        .catch((error) => {
          console.error(error);
        })
      });
    });
  })
  .catch((error) => {
    console.error(error);
  })
});

/*Evento que despliega las encuestas que creó el usuario, se le da la oportunidad de eliminar la encuesta o consultar los resultados de la misma.*/
misEnc.addEventListener("click", () => {
  $("#tablas").empty();
  $("#carouselExampleSlidesOnly").css("display","none");
  $(".modal_creditos").css("display","none");

  fetch("../dynamics/php/principalEncuestas.php?consulta=3")
  .then((response) => {
    return ret = response.text();
  })
  .then((text) => {
    let preguntas = JSON.parse(text);

    let tabla = document.createElement("table");
    tabla.setAttribute("id", "table");
    body.appendChild(tabla);

    let encabezado1 = document.createElement("th");
    encabezado1.innerText = "Título";
    tabla.appendChild(encabezado1);

    let encabezado2 = document.createElement("th");
    encabezado2.innerText = "Descripción";
    tabla.appendChild(encabezado2);

    let encabezado3 = document.createElement("th");
    encabezado3.innerText = "Consultar";
    tabla.appendChild(encabezado3);

    let encabezado4 = document.createElement("th");
    encabezado4.innerText = "Eliminar";
    tabla.appendChild(encabezado4);

    preguntas.forEach((element) => {
      let row = document.createElement("tr");

      let titulo = document.createElement("td");
      titulo.innerText = element[1];
      row.appendChild(titulo);

      let descripcion = document.createElement("td");
      descripcion.innerText = element[2];
      row.appendChild(descripcion);

      let espacioBoton = document.createElement("td");
      espacioBoton.classList.add("btn_consultar");

      let boton = document.createElement("button");
      boton.innerHTML = '<i class="far fa-eye"></i>';
      boton.setAttribute("id", element[0]);
      boton.classList.add("aEncuesta");
      espacioBoton.appendChild(boton);
      row.appendChild(espacioBoton);

      let td = document.createElement("td");
      td.classList.add("btn_eliminar");
      let eliminarEnc = document.createElement("button");
      eliminarEnc.classList.add("eliminar");
      eliminarEnc.innerHTML = "<i class='fas fa-trash'></i>";
      eliminarEnc.addEventListener("click", () => {
        fetch("../dynamics/php/eliminar.php?encuesta="+element[0])
        .then(() => {
          window.location.reload();
        })
        .catch((error) => {
          console.error(error);
        })
      });
      td.appendChild(eliminarEnc);
      row.appendChild(td);
      tabla.appendChild(row);

      eventBoton = document.getElementById(element[0]);
      eventBoton.addEventListener("click", () => {
        fetch("../dynamics/php/actual.php?encuesta="+element[0])
        .then((response) => {
          return contenido = response.text();
        })
        .then((text) => {
          body.innerHTML = text;
        })
        .catch((error) => {
          console.error(error);
        })
      });
    });
  })
  .catch((error) => {
    console.error(error);
  })
});

hacerEnc.addEventListener("click", () => {
  window.location = "./hacer.html";
});

perfil.addEventListener("click", () => {
  window.location = "../dynamics/php/perfil.php";
});

$("#creditos").click(function() {
  $("#content").empty();
  $("#tablas").empty();
  $("#carouselExampleSlidesOnly").css("display","none");
  $(".modal_creditos").css("display", "inline");
  fetch("../templates/creditos.html")
    .then((response) => {
      return response.text();
    })
    .then((data) => {
      document.getElementById("content").innerHTML = data;
      $("#btn_aceptar").click(function() {
        $(".modal_creditos").css("display", "none");
        $("#carouselExampleSlidesOnly").css("display", "inline");
      });
    })
    .catch((error) => {
      console.error(error);
    })
});

cSesion.addEventListener("click", () => {
  window.location = "../dynamics/php/cerrarS.php";
});
