/* Peticiones para Agregar*/

$(document).on("click", "#alimento_agregar", function () {
  $(document).on("change", "#archivo_agregar", function () {
    let imgCodificada = URL.createObjectURL(this.files[0]);
    $("#imgPrev_agregar").attr("src", imgCodificada);
  });
});

function agregar(tabla, datos) {
  fetch(`php/agregar.php?tabla=${tabla}`, {
    method: "POST",
    body: datos,
  })
    .then((res) => res.json())
    .then((data) => {
      datos = null;
      if (data == "correcto" || data == "notas") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Registro agregado.",
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
          position: "center",
          icon: "success",
          title: "Nota agregada.",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(Reedireccion, 500);
        function Reedireccion() {
          location.href = "https://cocinas-aurora.herokuapp.com/";
        }
      } else if (data == "notas") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Nota agregada.",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(Reedireccion, 500);
        function Reedireccion() {
          location.href =
            "https://cocinas-aurora.herokuapp.com/control_panel/" + tabla;
        }
      } else if (data == "correo") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Correo enviado.",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(Reedireccion, 500);
        function Reedireccion() {
          location.href =
            "https://cocinas-aurora.herokuapp.com/control_panel/" + tabla;
        }
      } else if (data == "vacio") {
        Swal.fire({
          position: "center",
          icon: "error",
          title: "Todos los campos son obligatorios",
          showConfirmButton: false,
          timer: 3000,
        });
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

/* Peticiones para Editar */

$(document).on("click", "#btn_editarAdmin", function () {
  let fila;
  fila = $(this).closest("tr");
  let nombres = fila.find("#admin_tdNombres:eq(0)").text();
  let apellidos = fila.find("#admin_tdApellidos:eq(0)").text();
  let correo = fila.find("#admin_tdCorreo:eq(0)").text();
  let tipo_admin = fila.find("#admin_tdTipoAdmin:eq(0)").text();

  if (tipo_admin == "root") {
    tipo_admin = 1;
  } else {
    tipo_admin = 2;
  }

  $("#nombres_editar").val(nombres);
  $("#apellidos_editar").val(apellidos);
  $("#correo_editar").val(correo);
  $("#tipo_admin_editar").val(tipo_admin);
});

$(document).on("click", "#btn_editarAlimento", function () {
  let fila;
  fila = $(this).closest("tr");
  let id = fila.find("#comida_tdID:eq(0)").text();
  let nombre = fila.find("#comida_tdNombre:eq(0)").text();
  let dia = fila.find("#comida_tdDia:eq(0)").text();
  let descripcion = fila.find("#comida_tdDesc:eq(0)").text();
  let precio_cuarto = fila.find("comida_tdPrecioCuarto:eq(0)").text();
  let precio_medio = fila.find("comida_tdPrecioMedio:eq(0)").text();
  let precio_litro = fila.find("comida_tdPrecioLitro:eq(0)").text();
  let img = fila.find("#alimentoIMG:eq(0)").attr("src");

  $("#id_editar").val(id);
  $("#nombre_editar").val(nombre);
  $("#dia_semana_editar").val(dia);
  $("#descripcion_editar").val(descripcion);
  $("#precioCuarto_editar").val(precio_cuarto);
  $("#precioMedio_editar").val(precio_medio);
  $("#precioLitro_editar").val(precio_litro);
  $("#precioOrden_editar").val(precio_orden);
  $("#imgPrev_editar").attr("src", img);

  $(document).on("change", "#archivo_editar", function () {
    let imgCodificada = URL.createObjectURL(this.files[0]);
    $("#imgPrev_editar").attr("src", imgCodificada);
  });
});

$(document).on("click", "#btn_editarAntojito", function () {
  let fila;
  fila = $(this).closest("tr");
  let id = fila.find("#comida_tdID:eq(0)").text();
  let nombre = fila.find("#comida_tdNombre:eq(0)").text();
  let dia = fila.find("#comida_tdDia:eq(0)").text();
  let descripcion = fila.find("#comida_tdDesc:eq(0)").text();
  let precio = fila.find("#comida_tdPrecio:eq(0)").text();
  let img = fila.find("#alimentoIMG:eq(0)").attr("src");

  let precio_separado = precio.split(" ");
  let precio_final = precio_separado[0].split("$");

  if (precio_separado[2] == "pieza") {
    $("#piezaText_editar").prop("checked", true);
  } else if (precio_separado[2] == "orden") {
    $("#ordenText_editar").prop("checked", true);
  }

  $("#id_editar").val(id);
  $("#nombre_editar").val(nombre);
  $("#dia_semana_editar").val(dia);
  $("#descripcion_editar").val(descripcion);
  $("#precioPiezaOrden_editar").val(precio_final[1]);
  $("#imgPrev_editar").attr("src", img);

  $(document).on("change", "#archivo_editar", function () {
    let imgCodificada = URL.createObjectURL(this.files[0]);
    $("#imgPrev_editar").attr("src", imgCodificada);
  });
});

$(document).on("click", "#btn_editarVenta", function () {
  let fila;
  fila = $(this).closest("tr");
  let id = fila.find("#venta_tdID:eq(0)").text();
  let dia = fila.find("#venta_tdDia:eq(0)").text();
  let nombre = fila.find("#venta_tdNombre:eq(0)").text();
  let cantidad = fila.find("#venta_tdCantidad:eq(0)").text();
  let total = fila.find("#venta_tdTotal:eq(0)").text();

  $("#id_editar").val(id);
  $("#dia_editar").val(dia);
  $("#nombre_editar").val(nombre);
  $("#cantidad_editar").val(cantidad);
  $("#total_editar").val(total);
});

$(document).on("click", "#btn_editarHorario", function () {
  let fila;
  fila = $(this).closest("tr");
  let id = fila.find("#horario_tdID:eq(0)").text();
  let dia = fila.find("#horario_tdDia:eq(0)").text();
  let horario_apertura = fila.find("#horario_tdHorarioApertura:eq(0)").text();
  let horario_cierre = fila.find("#horario_tdHorarioCierre:eq(0)").text();

  if (horario_apertura.indexOf("pm") > 0) {
    horario_apertura = horario_apertura.split("pm");
    var fechaFormatAp = new Date(`2021-04-02T${horario_apertura[0]}`);
    var utcCi = 12 * 60;
    fechaFormatAp.setMinutes(fechaFormatAp.getMinutes() + utcCi);
    $("#apertura_editar").val(fechaFormatAp.toLocaleTimeString());
  } else {
    horario_apertura = horario_apertura.split("am");
    $("#apertura_editar").val(horario_apertura[0]);
  }

  if (horario_cierre.indexOf("pm") > 0) {
    horario_cierre = horario_cierre.split("pm");
    var fechaFormatCi = new Date(`2021-04-02T${horario_cierre[0]}`);
    var utcCi = 12 * 60;
    fechaFormatCi.setMinutes(fechaFormatCi.getMinutes() + utcCi);
    $("#cierre_editar").val(fechaFormatCi.toLocaleTimeString());
  } else {
    horario_cierre = horario_cierre.split("am");
    $("#cierre_editar").val(horario_cierre[0]);
  }

  $("#id_editar").val(id);
  $("#dia_editar").val(dia);
});

function editar(tabla, datos, id) {
  fetch(`php/editar.php?id=${id}&tabla=${tabla}`, {
    method: "POST",
    body: datos,
  })
    .then((res) => res.json())
    .then((data) => {
      datos = null;
      if (data == "correcto") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Registro editado.",
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
          position: "center",
          icon: "success",
          title: "Nota editada.",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(Reedireccion, 500);
        function Reedireccion() {
          location.href = "https://cocinas-aurora.herokuapp.com/control_panel/";
        }
      } else if (data == "notas") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Nota editada.",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(Reedireccion, 500);
        function Reedireccion() {
          location.href =
            "https://cocinas-aurora.herokuapp.com/control_panel/" + tabla;
        }
      } else if (data == "vacio") {
        Swal.fire({
          position: "center",
          icon: "error",
          title: "Todos los campos son obligatorios",
          showConfirmButton: false,
          timer: 3000,
        });
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

/* Validar formularios */

function agregarAdmin(tabla) {
  let agregarRegistros = document.getElementById("agregar");
  agregarRegistros.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(agregarRegistros);

    let nombre = datos.get("nombres").trim();
    let apellidos = datos.get("apellidos").trim();
    let correo = datos.get("correo").trim();
    let password = datos.get("password").trim();

    let validarNombre = validarSoloLetras(nombre);
    let validarApellidos = validarSoloLetras(apellidos);
    let validarEmail = validarCorreo(correo);

    if (nombre == "" || apellidos == "" || correo == "" || password == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (nombre.trim().length >= 3 && validarNombre) {
        if (apellidos.trim().length >= 3 && validarApellidos) {
          if (validarEmail) {
            if (password.trim().length >= 8) {
              agregar(tabla, datos);
              agregarRegistros = null;
            } else {
              Swal.fire(
                "Aviso!",
                "La contraseña debe de tener al menos 8 carácteres",
                "warning"
              );
              agregarRegistros = null;
            }
          } else {
            Swal.fire(
              "Aviso!",
              "El correo debe tener formato de email (@example.com)",
              "warning"
            );
            agregarRegistros = null;
          }
        } else {
          Swal.fire("Aviso!", "El apellido no es válido", "warning");
          agregarRegistros = null;
        }
      } else {
        Swal.fire("Aviso!", "El nombre no es válido", "warning");
        agregarRegistros = null;
      }
    }
  });
}

function editarAdmin(tabla) {
  let editarRegistros = document.getElementById("editar");
  editarRegistros.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(editarRegistros);

    let nombre = datos.get("nombres").trim();
    let apellidos = datos.get("apellidos").trim();
    let correo = datos.get("correo").trim();

    let validarNombre = validarSoloLetras(nombre);
    let validarApellidos = validarSoloLetras(apellidos);
    let validarEmail = validarCorreo(correo);

    if (nombre == "" || apellidos == "" || correo == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (nombre.trim().length >= 3 && validarNombre) {
        if (apellidos.trim().length >= 3 && validarApellidos) {
          if (validarEmail) {
            editar(tabla, datos);
            editarRegistros = null;
          } else {
            Swal.fire(
              "Aviso!",
              "El correo debe tener formato de email (@example.com)",
              "warning"
            );
            editarRegistros = null;
          }
        } else {
          Swal.fire("Aviso!", "El apellido no es válido", "warning");
          editarRegistros = null;
        }
      } else {
        Swal.fire("Aviso!", "El nombre no es válido", "warning");
        editarRegistros = null;
      }
    }
  });
}

function agregarAlimento(tabla) {
  let agregarRegistros = document.getElementById("agregar");
  agregarRegistros.addEventListener("submit", (e) => {
    e.preventDefault();
    let datos = new FormData(agregarRegistros);
    let nombre = datos.get("nombre").trim();
    let dia_semana = datos.get("dia_semana").trim();
    let descripcion = datos.get("descripcion").trim();

    let validarNombre = validarSoloLetras(nombre);
    let validarDia = validarSoloLetras(dia_semana);

    let precio_cuarto = parseFloat(datos.get("precio_cuarto"));
    let precio_medio = parseFloat(datos.get("precio_medio"));
    let precio_litro = parseFloat(datos.get("precio_litro"));
    let precio = parseFloat(datos.get("precio"));
    if (precio_cuarto > 0 && precio_medio > 0 && precio_litro > 0) {
      if (
        nombre == "" ||
        dia_semana == "" ||
        descripcion == "" ||
        precio_cuarto == 0 ||
        precio_medio == 0 ||
        precio_litro == 0
      ) {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      } else {
        if (nombre.trim().length >= 3 && validarNombre) {
          if (dia_semana.trim().length >= 5 && validarDia) {
            if (descripcion.trim().length >= 3) {
              if (precio_cuarto > 0) {
                if (precio_medio > 0) {
                  if (precio_litro > 0) {
                    agregar(tabla, datos);
                    agregarRegistros = null;
                    datos = null;
                  } else {
                    Swal.fire(
                      "Aviso!",
                      "El precio del litro no es válido",
                      "warning"
                    );
                    agregarRegistros = null;
                    datos = null;
                  }
                } else {
                  Swal.fire(
                    "Aviso!",
                    "El precio del medio no es válido",
                    "warning"
                  );
                  agregarRegistros = null;
                  datos = null;
                }
              } else {
                Swal.fire(
                  "Aviso!",
                  "El precio del cuarto no es válido",
                  "warning"
                );
                agregarRegistros = null;
                datos = null;
              }
            } else {
              Swal.fire(
                "Aviso!",
                "La descripción es demasiada corta",
                "warning"
              );
              agregarRegistros = null;
              datos = null;
            }
          } else {
            Swal.fire("Aviso!", "El día no es valido", "warning");
            agregarRegistros = null;
            datos = null;
          }
        } else {
          Swal.fire("Aviso!", "El nombre no es valido", "warning");
          agregarRegistros = null;
          datos = null;
        }
      }
    } else if (precio > 0) {
      if (
        nombre == "" ||
        dia_semana == "" ||
        descripcion == "" ||
        precio == 0
      ) {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      } else {
        if (nombre.trim().length >= 3 && validarNombre) {
          if (dia_semana.trim().length >= 5 && validarDia) {
            if (descripcion.trim().length >= 3) {
              if (precio > 0) {
                agregar(tabla, datos);
                agregarRegistros = null;
                datos = null;
              } else {
                Swal.fire("Aviso!", "El precio no es válido", "warning");
                agregarRegistros = null;
                datos = null;
              }
            } else {
              Swal.fire(
                "Aviso!",
                "La descripción es demasiada corta",
                "warning"
              );
              agregarRegistros = null;
              datos = null;
            }
          } else {
            Swal.fire("Aviso!", "El día no es valido", "warning");
            agregarRegistros = null;
            datos = null;
          }
        } else {
          Swal.fire("Aviso!", "El nombre no es valido", "warning");
          agregarRegistros = null;
          datos = null;
        }
      }
    }
  });
}

function editarAlimento(tabla) {
  const editarRegistros = document.getElementById("editar");
  editarRegistros.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(editarRegistros);

    let nombre = datos.get("nombre").trim();
    let dia_semana = datos.get("dia_semana").trim();
    let descripcion = datos.get("descripcion").trim();
    let validarNombre = validarSoloLetras(nombre);
    let validarDia = validarSoloLetras(dia_semana);

    let precio_cuarto = parseFloat(datos.get("precio_cuarto"));
    let precio_medio = parseFloat(datos.get("precio_medio"));
    let precio_litro = parseFloat(datos.get("precio_litro"));
    let precio = parseFloat(datos.get("precio"));

    if (precio_cuarto > 0 && precio_medio > 0 && precio_litro > 0) {
      if (
        nombre == "" ||
        dia_semana == "" ||
        descripcion == "" ||
        precio_cuarto == 0 ||
        precio_medio == 0 ||
        precio_litro == 0
      ) {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      } else {
        if (nombre.trim().length >= 3 && validarNombre) {
          if (dia_semana.trim().length >= 5 && validarDia) {
            if (descripcion.trim().length >= 3) {
              if (precio_cuarto > 0) {
                if (precio_medio > 0) {
                  if (precio_litro > 0) {
                    editar(tabla, datos);
                    editarRegistros = null;
                    datos = null;
                  } else {
                    Swal.fire(
                      "Aviso!",
                      "El precio del litro no es válido",
                      "warning"
                    );
                    editarRegistros = null;
                    datos = null;
                  }
                } else {
                  Swal.fire(
                    "Aviso!",
                    "El precio del medio no es válido",
                    "warning"
                  );
                  editarRegistros = null;
                  datos = null;
                }
              } else {
                Swal.fire(
                  "Aviso!",
                  "El precio del cuarto no es válido",
                  "warning"
                );
                editarRegistros = null;
                datos = null;
              }
            } else {
              Swal.fire(
                "Aviso!",
                "La descripción es demasiada corta",
                "warning"
              );
              editarRegistros = null;
              datos = null;
            }
          } else {
            Swal.fire("Aviso!", "El día no es valido", "warning");
            editarRegistros = null;
            datos = null;
          }
        } else {
          Swal.fire("Aviso!", "El nombre no es valido", "warning");
          editarRegistros = null;
          datos = null;
        }
      }
    } else if (precio > 0) {
      if (
        nombre == "" ||
        dia_semana == "" ||
        descripcion == "" ||
        precio == 0
      ) {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      } else {
        if (nombre.trim().length >= 3 && validarNombre) {
          if (dia_semana.trim().length >= 5 && validarDia) {
            if (descripcion.trim().length >= 3) {
              if (precio > 0) {
                editar(tabla, datos);
                editarRegistros = null;
                datos = null;
              } else {
                Swal.fire("Aviso!", "El precio no es válido", "warning");
                editarRegistros = null;
                datos = null;
              }
            } else {
              Swal.fire(
                "Aviso!",
                "La descripción es demasiada corta",
                "warning"
              );
              editarRegistros = null;
              datos = null;
            }
          } else {
            Swal.fire("Aviso!", "El día no es valido", "warning");
            editarRegistros = null;
            datos = null;
          }
        } else {
          Swal.fire("Aviso!", "El nombre no es valido", "warning");
          editarRegistros = null;
          datos = null;
        }
      }
    }
  });
}

function enviarCorreo(tabla) {
  let form_mensaje = document.getElementById("agregar");
  form_mensaje.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(form_mensaje);

    let correo = datos.get("email").trim();
    let mensaje = datos.get("mensaje_correo").trim();

    let validarEmail = validarCorreo(correo);

    if (mensaje == "" || correo == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (mensaje.length >= 3) {
        if (validarEmail) {
          agregar(tabla, datos);
          form_mensaje = null;
        } else {
          Swal.fire(
            "Aviso!",
            "El correo debe tener formato de email (@example.com)",
            "warning"
          );
          form_mensaje = null;
        }
      } else {
        Swal.fire("Aviso!", "El mensaje es demasiado corto", "warning");
        form_mensaje = null;
      }
    }
  });
}

function agregarVenta(tabla) {
  const agregarRegistros = document.getElementById("agregar");
  agregarRegistros.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(agregarRegistros);

    let dia_semana = datos.get("dia").trim();
    let nombre = datos.get("nombre").trim();
    let total = parseFloat(datos.get("total"));

    let validarNombre = validarSoloLetras(nombre);
    let validarDia = validarSoloLetras(dia_semana);

    if (nombre == "" || dia_semana == "" || total == 0) {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (nombre.trim().length >= 3 && validarNombre) {
        if (dia_semana.trim().length >= 5 && validarDia) {
          if (total > 0) {
            agregar(tabla, datos);
            agregarRegistros = null;
          } else {
            Swal.fire(
              "Aviso!",
              "El total debe de ser diferente a 0",
              "warning"
            );
            agregarRegistros = null;
          }
        } else {
          Swal.fire("Aviso!", "El día es demasiado corto", "warning");
          agregarRegistros = null;
        }
      } else {
        Swal.fire("Aviso!", "El nombre es demasiado corto", "warning");
        agregarRegistros = null;
      }
    }
  });
}

function editarVenta(tabla) {
  const editarRegistros = document.getElementById("editar");
  editarRegistros.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(editarRegistros);

    let dia_semana = datos.get("dia").trim();
    let nombre = datos.get("nombre").trim();
    let total = parseFloat(datos.get("total"));

    let validarNombre = validarSoloLetras(nombre);
    let validarDia = validarSoloLetras(dia_semana);

    if (nombre == "" || dia_semana == "" || total == 0) {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (nombre.trim().length >= 3 && validarNombre) {
        if (dia_semana.trim().length >= 5 && validarDia) {
          if (total > 0) {
            editar(tabla, datos);
            editarRegistros = null;
          } else {
            Swal.fire(
              "Aviso!",
              "El total debe de ser diferente a 0",
              "warning"
            );
            editarRegistros = null;
          }
        } else {
          Swal.fire("Aviso!", "El día es demasiado corto", "warning");
          editarRegistros = null;
        }
      } else {
        Swal.fire("Aviso!", "El nombre es demasiado corto", "warning");
        editarRegistros = null;
      }
    }
  });
}

function editarHorario(tabla) {
  const editarRegistros = document.getElementById("editar");
  editarRegistros.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(editarRegistros);

    let dia_semana = datos.get("dia").trim();
    let horario_apertura = datos.get("apertura").trim();
    let horario_cierre = datos.get("cierre").trim();

    let validarDia = validarSoloLetras(dia_semana);

    if (dia_semana == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (dia_semana.length >= 5 && validarDia) {
        if (horario_apertura.length != "") {
          if (horario_cierre.length != "") {
            editar(tabla, datos);
            editarRegistros = null;
          } else {
            Swal.fire(
              "Aviso!",
              "Debe de ingresar un horario de cierre",
              "warning"
            );
            editarRegistros = null;
          }
        } else {
          Swal.fire(
            "Aviso!",
            "Debe de ingresar un horario de apertura",
            "warning"
          );
          editarRegistros = null;
        }
      } else {
        Swal.fire(
          "Aviso!",
          "El día es demasiado corto o no contiene el formato de texto",
          "warning"
        );
        editarRegistros = null;
      }
    }
  });
}

function agregarNota(tabla) {
  var agregarNotas = document.getElementById("agregar");
  agregarNotas.addEventListener("submit", function (e) {
    e.preventDefault();
    var datos = new FormData(agregarNotas);

    let nota = datos.get("nota").trim();

    if (nota == "") {
      Swal.fire("Aviso!", "Debes de llenar el campo", "warning");
    } else {
      if (nota.length > 3) {
        agregar(tabla, datos);
        agregarNotas = null;
      } else {
        Swal.fire(
          "Aviso!",
          "La nota debe de contener al menos 3 letras",
          "warning"
        );
        agregarNotas = null;
      }
    }
  });
}

function editarNota(tabla, id) {
  var editarNotas = document.getElementById("editar");
  editarNotas.addEventListener("submit", function (e) {
    e.preventDefault();
    var datos = new FormData(editarNotas);
    let nota = datos.get("nota").trim();

    if (nota == "") {
      Swal.fire("Aviso!", "Debes de llenar el campo", "warning");
    } else {
      if (nota.length > 3) {
        editar(tabla, datos, id);
        editarNotas = null;
      } else {
        Swal.fire(
          "Aviso!",
          "La nota debe de contener al menos 3 letras",
          "warning"
        );
        editarNotas = null;
      }
    }
  });
}

function editarEstatusNota(tabla, id) {
  Swal.fire({
    text: "¿Estás seguro que deseas editar el estatus de la nota?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Editada!",
        text: "estatus editado",
        icon: "success",
        showConfirmButton: false,
      });
      setTimeout(ReedireccionProductos, 800);
      function ReedireccionProductos() {
        location.href = `php/editar.php?id=${id}&tabla=${tabla}`;
      }
    }
  });
}

/*===============================================
    Válidamos solo letras
================================================*/
function validarSoloLetras(valor) {
  if (!/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ. ]*$/.test(valor)) {
    return false;
  }
  return true;
}

/*===============================================
    Válidamos un corrreo valido
================================================*/
function validarCorreo(valor) {
  if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(valor)) {
    return false;
  }

  return true;
}
