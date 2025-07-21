function EliminacionMult(tabla) {
  var formulario = document.getElementById("formulario");
  formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    var datos = new FormData(formulario);
    Swal.fire({
      title: "¿Estás seguro que deseas eliminar los registros?",
      text: "No podras recuperarlos.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`php/eliminarMult.php?tabla=${tabla}`, {
          method: "POST",
          body: datos,
        })
          .then((res) => res.json())
          .then((data) => {
            if (data == "correcto") {
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Registros eliminados exitosamente",
                showConfirmButton: false,
                timer: 1500,
              });
              setTimeout(ReedireccionAlimento, 500);
              function ReedireccionAlimento() {
                location.href =
                  "https://cocinas-aurora.herokuapp.com/control_panel/" + tabla;
              }
            } else {
              Swal.fire({
                position: "center",
                icon: "error",
                title: "Error en el servidor",
                showConfirmButton: false,
                timer: 3000,
              });
            }
          });
      }
    });
  });
}
