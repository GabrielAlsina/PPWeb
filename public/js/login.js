$(document).ready(function () {
  $("formLogin").on("submit", function (event) {
    let isValid = true;

    const username = $("#username").val().trim();
    if (username === "") {
      alert("Por favor, ingrese su nombre de usuario.");
      isValid = false;
    }

    const password = $("#password").val().trim();
    if (password === "") {
      alert("Por favor, ingrese su contraseña.");
      isValid = false;
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
});
