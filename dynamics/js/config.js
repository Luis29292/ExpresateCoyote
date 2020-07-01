//Eventos dónde el usuario (alumno, profesor o administrador) puede cambiar su correo o su contraseña, esto en un formulario
let bod = document.getElementsByTagName("body");
let form = document.getElementsByTagName("form");
var cCo = document.getElementById("cCo"); //Cambiar correo
var cC = document.getElementById("cC"); //Cambiar contraseña

function correo(e) {
  form[0].innerHTML = 'Correo Actual: <input type="text" name="coA" required><br><br>'
  form[0].innerHTML += 'Correo Nuevo: <input type="text" name="coN" required><br><br>'
  form[0].innerHTML += '<input type="submit" value="Cambiar">';
}

function contra (e) {
  form[0].innerHTML = 'Contraseña Actual: <input type="password" name="cA" required><br><br>'
  form[0].innerHTML += 'Contraseña Nueva: <input type="password" name="cN" required><br><br>'
  form[0].innerHTML += '<input type="submit" value="Cambiar">';
}

cCo.addEventListener('click', correo);

cC.addEventListener('click',contra);
