function ConfirmarEliminacion(tabla, id) {
  Swal.fire({
    title: "¿Estás seguro que deseas eliminar el registro?",
    text: "No podras recuperarlo.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`php/eliminar.php?id=${id}&tabla=${tabla}`, {
        method: "POST",
        body: JSON.stringify(tabla),
        headers: {
          "Content-type": "application/json",
        },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data == "correcto") {
            Swal.fire({
              icon: "success",
              title: "Registro eliminado exitosamente",
              showConfirmButton: false,
              timer: 1500,
            });
            setTimeout(Reedireccion, 500);
            function Reedireccion() {
              location.href =
                "https://cocinas-aurora.herokuapp.com/control_panel/" + tabla;
            }
          } else if (data == "notasI") {
            Swal.fire({
              icon: "success",
              title: "Registro eliminado exitosamente",
              showConfirmButton: false,
              timer: 1500,
            });
            setTimeout(Reedireccion, 500);
            function Reedireccion() {
              location.href =
                "https://cocinas-aurora.herokuapp.com/control_panel/";
            }
          } else {
            Swal.fire({
              icon: "error",
              title: "Error en el servidor",
              showConfirmButton: false,
              timer: 3000,
            });
          }
        });
    }
  });
}
