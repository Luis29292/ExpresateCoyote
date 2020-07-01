//Eventos donde al dar click en los botones "Alumno" o "Profesor" al momento de registrarte te manda el archivo HTML correspondiente al formulario del tipo de usuario
$("#alumno").click(function() {
  $("#campos").empty();
  fetch("../templates/alumno.html")
    .then((response) => {
      return response.text();
    })
    .then((data) => {
      document.getElementById("usuario").innerHTML = data;
    })
    .catch((error) => {
      console.error(error);
    })
});

$("#profesor").click(function() {
  $("#campos").empty();
  fetch("../templates/profesor.html")
    .then((response) => {
      return response.text();
    })
    .then((data) => {
      document.getElementById("usuario").innerHTML = data;
    })
    .catch((error) => {
      console.error(error);
    })
});
