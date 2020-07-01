//Eventos dónde al dar click en los botones, mandamos un modal para que elimine o bloquee al usuario deseado
$("#bloqUsu").click(function() {
  fetch("../../templates/bloquearUsuarios.html")
    .then((response) => {
      return response.text();
    })
    .then((data) => {
      document.getElementById("adminUsuarios").innerHTML = data;
      $("span").click(function() {
          $(".modal-Bloquear").css("display", "none");
      });
    })
    .catch((error) => {
      console.error(error);
    })
});

$("#elimUsu").click(function() {
  fetch("../../templates/eliminarUsuarios.html")
    .then((response) => {
      return response.text();
    })
    .then((data) => {
      document.getElementById("adminUsuarios").innerHTML = data;
      $("span").click(function() {
          $(".modal-Eliminar").css("display", "none");
      });
    })
    .catch((error) => {
      console.error(error);
    })
});
