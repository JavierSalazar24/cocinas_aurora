if (document.getElementById("btnPerfil")) {
  if (
    (document.getElementById("btnPerfil").addEventListener("click", (e) => {
      if (
        (e.preventDefault(),
        "Editar perfil" == document.getElementById("btnPerfil").innerHTML)
      )
        (document.getElementById("btnPerfil").innerHTML = "Guardar cambios"),
          (document.getElementById("nombres").disabled = !1),
          (document.getElementById("apellidos").disabled = !1);
      else {
        const e = document.getElementById("formPerfil"),
          t = new FormData(e);
        let n = t.get("nombres").trim(),
          i = t.get("apellidos").trim(),
          l = validarSoloLetras(n),
          r = validarSoloLetras(i);
        console.log("nombre", n.length);
        console.log("apellidos", i.length);
        "" == n || "" == i
          ? (Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning"),
            (e = null))
          : n.length >= 3 && l
          ? i.length >= 3 && r
            ? fetch("php/editar_perfil.php", { method: "POST", body: t })
                .then((e) => e.json())
                .then((e) => {
                  "correcto" == e
                    ? (Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Perfil actualizado",
                        showConfirmButton: !1,
                        timer: 1500,
                      }),
                      document.getElementById("btnPerfil").innerHTML)
                    : "vacio" == e
                    ? Swal.fire("Error!", "Datos vacíos", "error")
                    : "error" == e &&
                      Swal.fire("Error!", "Error en el servidor", "error");
                })
            : (Swal.fire("Aviso!", "El apellido no es válido", "warning"),
              (e = null))
          : (Swal.fire("Aviso!", "El nombre no es válido", "warning"),
            (e = null)),
          (document.getElementById("btnPerfil").innerHTML = "Editar perfil"),
          (document.getElementById("nombres").disabled = !0),
          (document.getElementById("apellidos").disabled = !0);
      }
    }),
    document.getElementById("nombrePerfil") &&
      document.getElementById("apellidosPerfil"))
  ) {
    const e = document.getElementById("nombres"),
      t = document.getElementById("apellidos");
    e.addEventListener("keyup", () => {
      (document.getElementById("nombrePerfil").innerText = ""),
        (document.getElementById("nombrePerfil").innerText += e.value);
    }),
      t.addEventListener("keyup", () => {
        (document.getElementById("apellidosPerfil").innerText = ""),
          (document.getElementById("apellidosPerfil").innerText += t.value);
      });
  }
  function validarSoloLetras(e) {
    return !!/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ.]*$/.test(e);
  }
}
if (document.getElementById("btnPerfilFace")) {
  document.getElementById("btnPerfilFace").addEventListener("click", (e) => {
    e.preventDefault(),
      Swal.fire({
        title: "Advertencia",
        text: "No puedes editar tu perfil de facebook desde aquí",
        icon: "warning",
        position: "center",
      });
  });
} else if (document.getElementById("btnPerfilGoogle")) {
  document.getElementById("btnPerfilFace").addEventListener("click", (e) => {
    e.preventDefault(),
      Swal.fire({
        title: "Advertencia",
        text: "No puedes editar tu perfil de google desde aquí",
        icon: "warning",
        position: "center",
      });
  });
}
