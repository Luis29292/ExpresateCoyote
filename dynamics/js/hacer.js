
/*Obtención de los elementos para aplicar sus eventos correspondintes.*/
let boton1 = document.getElementById("ag1");
let boton2 = document.getElementById("ag2");
let boton3 = document.getElementById("ag3");
let boton4 = document.getElementById("ag4");
let boton5 = document.getElementById("ag5");

let div = document.getElementById("opciones");
let div2 = document.getElementById("opciones2");
let div3 = document.getElementById("opciones3");
let div4 = document.getElementById("opciones4");
let div5 = document.getElementById("opciones5");

let nuevo = document.getElementById("new");
let nuevo2 = document.getElementById("new2");
let nuevo3 = document.getElementById("new3");
let nuevo4 = document.getElementById("new4");
let nuevo5 = document.getElementById("new5");

let agregar = document.getElementById("agregar");
let agregar2 = document.getElementById("agregar2");
let agregar3 = document.getElementById("agregar3");
let agregar4 = document.getElementById("agregar4");
let agregar5 = document.getElementById("agregar5");

let p1 = document.getElementById("P1");
let p2 = document.getElementById("P2");
let p3 = document.getElementById("P3");
let p4 = document.getElementById("P4");
let p5 = document.getElementById("P5");

let gen1 = document.getElementById("generar1");
let gen2 = document.getElementById("generar2");
let gen3 = document.getElementById("generar3");
let gen4 = document.getElementById("generar4");

let enc = document.getElementById("hacerEnc");
let finalizar = document.getElementById("finalizarEnc");
let selectU = document.getElementById("selectU");
let enviarUsu = document.getElementById("enviarUsu");
let cajaUsuarios = document.getElementById("cajaUsuarios");
let selectCategoria = document.getElementById("selectCategoria");
let agregarCat = document.getElementById("agregarCat");
let contador = 2;
let impresion = 1;
let cate = 1;
let opcionesFinales = [];
let preguntasFinales = [];
let invitados = [];
let opciones = [];
let accesoInvitados = false;

/*Se verifica si el usuario puede seleccionar a las personas que podrán contestar la encuesta.*//**/
fetch("../dynamics/php/consultaTipo.php")
  .then((response) => {
    return retsp = response.text();
  })
  .then((text) => {
    let tipo = parseInt(text,10);
    if (tipo != 2) {
      accesoInvitados = true;
      let select = document.createElement("select");
      select.setAttribute("id", "selectUsuarios");

      let todos = document.createElement("option");
      todos.setAttribute("value", "TODOS");
      todos.innerText = "Todos los usuarios";
      select.appendChild(todos);

      fetch("../dynamics/php/consultaUsu.php?consulta=1")
      .then((resp) => {
        return ret = resp.text();
      })
      .then((text)=>{
         let usuarios = JSON.parse(text);

         usuarios.forEach((element) => {
           let opcion = document.createElement("option");
           opcion.setAttribute("value", element[0]);
           opcion.innerText = element[1];
           select.appendChild(opcion);
         });
      })
      selectU.appendChild(select);
    }
  })
  .catch((error) => {
    console.error(error);
  })

/*Los botones del 1-5 se encargan de agregar al arreglo de opciones por pregunta las opciones que el usuario inttroduce. Esto mediante eventos. */
boton1.addEventListener("click", () => {
  impresion = 1;
  let input = $("#input").val();
  if (input != "") {
    opciones.push(input);

    if (opciones.length > 1) {
      $("#agregar").css("display", "inline");
    }

    $("#input").css("display", "none");
    $("#ag1").css("display", "none");

    if (opciones.length < 10) {
      $("#new").css("display", "inline");
    }

    $("#label").css("display", "none");
    $("#opciones").empty();

    for (valor of opciones) {
      fil = document.createElement("p");
      fil.innerText = impresion + ".- " + valor;
      div.appendChild(fil);
      impresion++;
    }
    input = "";
  }
});

boton2.addEventListener("click", () => {
  impresion = 1;
  let input = $("#input2").val();

  if (input != "") {
    opciones.push(input);

    if (opciones.length > 1) {
      $("#agregar2").css("display","inline");
    }

    $("#input2").css("display","none");
    $("#ag2").css("display","none");

    if (opciones.length < 10) {
      $("#new2").css("display","inline");
    }

    $("#label2").css("display","none");
    $("#opciones2").empty();

    for (valor of opciones) {
      fil = document.createElement("p");
      fil.innerText = impresion + ".- " + valor;
      div2.appendChild(fil);
      impresion++;
    }
    input = "";
  }
});

boton3.addEventListener("click", () => {
  impresion = 1;
  let input = $("#input3").val();

  if (input != "") {
    opciones.push(input);

    if (opciones.length > 1) {
      $("#agregar3").css("display","inline");
    }

    $("#input3").css("display","none");
    $("#ag3").css("display","none");

    if (opciones.length < 10) {
      $("#new3").css("display","inline");
    }

    $("#label3").css("display","none");
    $("#opciones3").empty();

    for (valor of opciones) {
      fil = document.createElement("p");
      fil.innerText = impresion + ".- " + valor;
      div3.appendChild(fil);
      impresion++;
    }
    input = "";
  }
});

boton4.addEventListener("click", () => {
  impresion = 1;
  let input = $("#input4").val();

  if (input != "") {
    opciones.push(input);
    if (opciones.length > 1) {
      $("#agregar4").css("display","inline");
    }

    $("#input4").css("display","none");
    $("#ag4").css("display","none");

    if (opciones.length < 10) {
      $("#new4").css("display","inline");
    }

    $("#label4").css("display","none");
    $("#opciones4").empty();

    for (valor of opciones) {
      fil = document.createElement("p");
      fil.innerText = impresion + ".- " + valor;
      div4.appendChild(fil);
      impresion++;
    }
    input = "";
  }
});

boton5.addEventListener("click", () => {
  impresion = 1;
  let input = $("#input5").val();

  if (input != "") {
    opciones.push(input);

    if (opciones.length > 1) {
      $("#agregar5").css("display","inline");
    }

    $("#input5").css("display","none");
    $("#ag5").css("display","none");

    if (opciones.length < 10) {
      $("#new5").css("display","inline");
    }

    $("#label5").css("display","none");
    $("#opciones5").empty();

    for (valor of opciones) {
      fil = document.createElement("p");
      fil.innerText = impresion + ".- " + valor;
      div5.appendChild(fil);
      impresion++;
    }
    input= "";
  }
});

/*Las variables nuevo del 1-5 se encargan de brindar la posibilidad de agregar una nueva opcion a la pregunta, esto mediante un boton.*/

nuevo.addEventListener("click", () => {
  $("#label").text("Opcion " + contador + ": ");
  $("#label").css("display","inline")
  $("#input").css("display","inline");
  $("#ag1").css("display","inline");
  $("#new").css("display","none");
  contador++;
});

nuevo2.addEventListener("click", () => {
  $("#label2").text("Opcion " + contador + ": ");
  $("#label2").css("display","inline")
  $("#input2").css("display","inline");
  $("#ag2").css("display","inline");
  $("#new2").css("display","none");
  contador++;
});

nuevo3.addEventListener("click", () => {
  $("#label3").text("Opcion " + contador + ": ");
  $("#label3").css("display","inline")
  $("#input3").css("display","inline");
  $("#ag3").css("display","inline");
  $("#new3").css("display","none");
  contador++;
});

nuevo4.addEventListener("click", () => {
  $("#label4").text("Opcion " + contador + ": ");
  $("#label4").css("display","inline")
  $("#input4").css("display","inline");
  $("#ag4").css("display","inline");
  $("#new4").css("display","none");
  contador++;
});

nuevo5.addEventListener("click", () => {
  $("#label5").text("Opcion " + contador + ": ");
  $("#label5").css("display","inline")
  $("#input5").css("display","inline");
  $("#ag5").css("display","inline");
  $("#new5").css("display","none");
  contador++;
});

/*Agregar 1-5 agregan las opciones de la pregunta al arreglo de todas las opciones, asñi como también la pregunta al arreglo de preguntas*/
agregar.addEventListener("click", () => {
  let pregunta= $("#preg").val();

  if (pregunta != "") {
    p1.innerText = pregunta;
    $("#preg").remove();
    $("#ingresar").remove();
    opcionesFinales.push(opciones);
    preguntasFinales.push(pregunta);
    $("#new").remove();
    $("#agregar").remove();
    $("#generar1").css("display","inline");
    $("#finalizarEnc").css("display","inline");
    opciones = [];
    impresion = 1;
    contador = 2;
  }
});

gen1.addEventListener("click", () => {
  $("#content-pregunta2").css("display","inline");
  $("#generar1").remove();
});

agregar2.addEventListener("click", () => {
  let pregunta = $("#preg2").val();

  if (pregunta != "") {
    p2.innerText = pregunta;
    $("#preg2").remove();
    $("#ingresar2").remove();
    opcionesFinales.push(opciones);
    preguntasFinales.push(pregunta);
    $("#new2").remove();
    $("#agregar2").remove();
    $("#generar2").css("display","inline");
    opciones = [];
    impresion = 1;
    contador = 2;
  }
});

gen2.addEventListener("click", () => {
  $("#content-pregunta3").css("display","inline");
  $("#generar2").remove();
});

agregar3.addEventListener("click", () => {
  let pregunta = $("#preg3").val();

  if (pregunta != "") {
    p3.innerText = pregunta;
    $("#preg3").remove();
    $("#ingresar3").remove();
    opcionesFinales.push(opciones);
    preguntasFinales.push(pregunta);
    $("#new3").remove();
    $("#agregar3").remove();
    $("#generar3").css("display","inline");
    opciones = [];
    impresion = 1;
    contador = 3;
  }
});

gen3.addEventListener("click", () => {
  $("#content-pregunta4").css("display","inline");
  $("#generar3").remove();
});

agregar4.addEventListener("click", () => {

  let pregunta= $("#preg4").val();

   if (pregunta != "") {
    p4.innerText = pregunta;
    $("#preg4").remove();
    $("#ingresar4").remove();
    opcionesFinales.push(opciones);
    preguntasFinales.push(pregunta);
    $("#new4").remove();
    $("#agregar4").remove();
    $("#generar4").css("display","inline");
    opciones = [];
    impresion = 1;
    contador = 3;
  }
});

gen4.addEventListener("click", () => {
  $("#content-pregunta5").css("display","inline");
  $("#generar4").remove();
});

agregar5.addEventListener("click", () => {
  let pregunta= $("#preg5").val();

  if (pregunta != "") {
    p5.innerText = pregunta;
    $("#preg5").remove();
    $("#ingresar5").remove();
    opcionesFinales.push(opciones);
    preguntasFinales.push(pregunta);
    $("#new5").remove();
    $("#agregar5").remove();
    opciones = [];
    impresion = 1;
    contador = 3;
  }
});

/*Cuando se finaliza se despliegan las opciones de descripcion y título de la encuesta, y en caso de que el usuario pueda, que sseleccione a los usuarios que podrán visualizar la encuesta*/
finalizar.addEventListener("click", () => {
  $("#hacerEnc").css("display","inline");
  $("#finalizarEnc").css("display","none");
  $("#labelInfGen").css("display","inline");
  $("#infoGeneral").css("display","inline");
  $("#labelDesc").css("display","inline");
  $("#descripcion").css("display","inline");
  $("#selectCategoria").css("display","inline");
  $("#labelCategoria").css("display","inline");
  $("#agregarCat").css("display","inline");

  fetch("../dynamics/php/consultaCategoria.php")
  .then((response) => {
    return categs = response.text();
  })
  .then((text) => {
    let categorias = JSON.parse(text);

    categorias.forEach((element) => {
      let opcionCat = document.createElement("option");
      opcionCat.setAttribute("value",element[0]);
      opcionCat.innerText = element[1];
      selectCategoria.appendChild(opcionCat);
    });
  })
  .catch((error) => {
    console.error(error);
  })

  $("#generar1").remove();
  $("#generar2").remove();
  $("#generar3").remove();
  $("#generar4").remove();

  if (accesoInvitados == true) {
    $("#selectUsuarios").css("display","inline");
    $("#enviarUsu").css("display","inline");
    $("#cajaUsuarios").css("display","inline");
  }
});

agregarCat.addEventListener("click", () => {
  cate = $("#selectCategoria").val();
  $("#selectCategoria").css("display","none");
  $("#labelCategoria").css("display","none");
  $("#agregarCat").css("display","none");
});

let texto = document.createElement("p");
texto.innerText = "Las personas que podrán acceder a la encuesta son: ";
cajaUsuarios.appendChild(texto);

enviarUsu.addEventListener("click", () => {
  let idUsuario = $("#selectUsuarios").val();
  let aCaja = document.createElement("p");

  if (idUsuario != "TODOS") {
    if (invitados.length > 0) {
      for(valor of invitados) {
        if(valor != idUsuario) {
          invitados.push(idUsuario);

          fetch("../dynamics/php/consultaUsu.php?consulta=2&usuario="+idUsuario)
          .then((response) => {
            return usuario = response.text();
          })
          .then((text) => {
            aCaja.innerText = text;
          })
          .catch((error) => {
            console.error(error);
          })
        }
      }
    }
    else {
      invitados.push(idUsuario);

      fetch("../dynamics/php/consultaUsu.php?consulta=2&usuario="+idUsuario)
      .then((response) => {
        return usuario = response.text();
      }).then((text) => {
        aCaja.innerText = text;
      })
      .catch((error) => {
        console.error(error);
      })
    }
  }
  else {
    invitados = [];
    $("#cajaUsuarios").empty();
    aCaja.innerText = "Todos los usuarios podrán ver la encuesta";
    $("#enviarUsu").remove();
    $("#selectUsuarios").remove();
  }
  cajaUsuarios.appendChild(aCaja);
});

/*Con este evento se hace la peticion al archivo php para que guarde en la base de datos toda la encuesta, opciones, invitados, preguntas,etc.*/
enc.addEventListener("click", () => {
  let descripcionFinal = $("#descripcion").val();
  let tituloEncuesta = $("#infoGeneral").val();

  if (descripcionFinal != "" && tituloEncuesta != "") {
    let opcionesAMandar = JSON.stringify(opcionesFinales);
    let preguntasAMandar = JSON.stringify(preguntasFinales);
    let invitadosAMandar = JSON.stringify(invitados);
    let categoriaAMandar = cate;

    fetch("../dynamics/php/encuesta.php?preguntas="+preguntasAMandar+"&opciones="+opcionesAMandar+"&titulo="+tituloEncuesta+"&descripcion="+descripcionFinal+"&invitados="+invitadosAMandar+"&categoria="+categoriaAMandar)
    .then((response) => {
      return resp = response.text();
    })
    .then((text) => {
      window.location = "./encuestaExitosa.html";
    })
    .catch((error) => {
      console.error(error);
    })
  }
});
