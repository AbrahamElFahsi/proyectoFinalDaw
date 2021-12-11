

function myFunction() {
    let x = document.getElementById("pass");
    if (x.type === "password") {
      x.type = "text";
      $("#mMostrar").html("Ocultar ");
    } else {
      x.type = "password";
      $("#mMostrar").html("Mostrar ");
    }
  }