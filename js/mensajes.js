if (document.getElementById("form_mensajes")) {
  const form_mensajes = document.getElementById("form_mensajes");
  form_mensajes.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(form_mensajes);
    let nombre = datos.get("nombre").trim();
    let mensaje = datos.get("mensaje").trim();
    let correo = datos.get("correo").trim();
    console.log(nombre);
    console.log(correo);
    console.log(mensaje);
    let validarNombre = validarSoloLetras(nombre);
    let validarEmail = validarCorreo(correo);
    if (nombre == "" || mensaje == "" || correo == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (nombre.length >= 3 && validarNombre) {
        if (mensaje.length >= 3) {
          if (validarEmail) {
            fetch("php/mensajes.php", { method: "POST", body: datos })
              .then((res) => res.json())
              .then((data) => {
                if (data == "correcto") {
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Mensaje enviado",
                    showConfirmButton: !1,
                    timer: 1500,
                  });
                  form_mensajes.reset();
                } else if (data == "vacio") {
                  Swal.fire("Error!", "Datos vacíos", "error");
                } else if (data == "error") {
                  Swal.fire("Error!", "Error en el servidor", "error");
                }
              });
          } else {
            Swal.fire(
              "Aviso!",
              "El correo debe tener formato de email (@example.com)",
              "warning"
            );
          }
        } else {
          Swal.fire("Aviso!", "El mensaje es demasiado corto", "warning");
        }
      } else {
        Swal.fire("Aviso!", "El nombre es demasiado corto", "warning");
      }
    }
  });
}
function validarSoloLetras(valor) {
  if (!/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/.test(valor)) {
    return !1;
  }
  return !0;
}
function validarCorreo(valor) {
  if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(valor)) {
    return !1;
  }
  return !0;
}
