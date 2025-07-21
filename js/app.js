if (document.querySelector(".contenedor-slider")) {
  let e = 1,
    r = 1;
  const t = document.querySelector(".slider"),
    o = t.children,
    a = t.childElementCount,
    s = document.querySelector(".dots"),
    i = document.querySelector(".prev"),
    n = document.querySelector(".next");
  for (let e = 0; e < a; e++) s.innerHTML += '<span class="dot"></span>';
  function mostrarSlider(t) {
    r > a ? (r = 1) : r++, t > a && (e = 1), t < 1 && (e = a);
    for (let e = 0; e < a; e++) o[e].classList.remove("active");
    for (let e = 0; e < s.children.length; e++)
      s.children[e].classList.remove("active");
    o[e - 1].classList.add("active"), s.children[e - 1].classList.add("active");
  }
  mostrarSlider(e),
    setInterval(() => {
      mostrarSlider((e = r));
    }, 5e3),
    n.addEventListener("click", (t) => {
      mostrarSlider((e += 1)), (r = e);
    }),
    i.addEventListener("click", (t) => {
      mostrarSlider((e += -1)), (r = e);
    });
  for (let t = 0; t < s.children.length; t++)
    s.children[t].addEventListener("click", () => {
      mostrarSlider((e = t + 1)), (r = t + 1);
    });
}
const tabLink = document.querySelectorAll(".tab-link"),
  formularios = document.querySelectorAll(".formulario");
for (let e = 0; e < tabLink.length; e++)
  tabLink[e].addEventListener("click", () => {
    tabLink.forEach((e) => e.classList.remove("active")),
      tabLink[e].classList.add("active"),
      formularios.forEach((e) => e.classList.remove("active")),
      formularios[e].classList.add("active");
  });
const mostrarClave = document.querySelectorAll(".mostrarClave"),
  inputPass = document.querySelectorAll(".clave");
for (let e = 0; e < mostrarClave.length; e++)
  mostrarClave[e].addEventListener("click", () => {
    "password" === inputPass[e].type
      ? (inputPass[e].setAttribute("type", "text"),
        mostrarClave[e].classList.remove("fa-eye"),
        mostrarClave[e].classList.add("fa-eye-slash"),
        mostrarClave[e].classList.add("active"))
      : (inputPass[e].setAttribute("type", "password"),
        mostrarClave[e].classList.remove("fa-eye-slash"),
        mostrarClave[e].classList.add("fa-eye"),
        mostrarClave[e].classList.remove("active"));
  });
if (document.getElementById("formRegistro")) {
  const btnRegistro = document.getElementById("btnRegistro");
  const terminos = document.getElementById("terminos");
  terminos.addEventListener("change", function () {
    if (this.checked == true) {
      btnRegistro.disabled = false;
    } else {
      btnRegistro.disabled = true;
      Swal.fire({
        title: "Advertencia",
        text: "Debe de aceptar los terminos de privacidad",
        icon: "warning",
        position: "center",
      });
    }
  });
  const e = document.getElementById("formRegistro");
  e.addEventListener("submit", (r) => {
    r.preventDefault();
    const t = new FormData(e);
    let o = t.get("nombres").trim(),
      a = t.get("apellidos").trim(),
      s = t.get("correo").trim(),
      i = t.get("password").trim(),
      n = validarSoloLetras(o),
      l = validarSoloLetras(a),
      c = validarCorreo(s);
    "" == o || "" == a || "" == s || "" == i
      ? Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning")
      : o.length >= 3 && n
      ? a.length >= 3 && l
        ? c
          ? i.length >= 8
            ? fetch("php/registrarse.php", { method: "POST", body: t })
                .then((e) => e.json())
                .then((e) => {
                  if ("correcto" == e) {
                    Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "Bienvenido a Cocinas Aurora",
                      showConfirmButton: !1,
                      timer: 1500,
                    }),
                      setTimeout(function () {
                        location.href = "https://cocinas-aurora.herokuapp.com/";
                      }, 500);
                  } else
                    "existente" == e
                      ? Swal.fire("Error!", "El correo ya existe", "error")
                      : "vacio" == e
                      ? Swal.fire("Error!", "Datos vacíos", "error")
                      : "error" == e &&
                        Swal.fire("Error!", "Error en el servidor", "error");
                })
            : Swal.fire(
                "Aviso!",
                "La contraseña debe de tener al menos 8 carácteres",
                "warning"
              )
          : Swal.fire(
              "Aviso!",
              "El correo debe tener formato de email (@example.com)",
              "warning"
            )
        : Swal.fire("Aviso!", "El apellido no es válido", "warning")
      : Swal.fire("Aviso!", "El nombre no es válido", "warning");
  });
}
if (document.getElementById("formLogin")) {
  const e = document.getElementById("formLogin");
  e.addEventListener("submit", (r) => {
    r.preventDefault();
    const t = new FormData(e);
    let o = t.get("correo").trim(),
      a = t.get("password").trim(),
      s = validarCorreo(o);
    "" == o || "" == a
      ? Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning")
      : s
      ? a.length >= 8
        ? fetch("php/login.php", { method: "POST", body: t })
            .then((e) => e.json())
            .then((e) => {
              if ("user" == e) {
                function r() {
                  location.href = "https://cocinas-aurora.herokuapp.com/";
                }
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Bienvenido a Cocinas Aurora",
                  showConfirmButton: !1,
                  timer: 1500,
                }),
                  setTimeout(r, 500);
              } else if ("admin" == e) {
                function r() {
                  location.href =
                    "https://cocinas-aurora.herokuapp.com/control_panel/";
                }
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Bienvenido a su panel de administrador",
                  showConfirmButton: !1,
                  timer: 1500,
                }),
                  setTimeout(r, 500);
              } else
                "null" == e
                  ? Swal.fire(
                      "Error!",
                      "Correo o contraseña incorrecta",
                      "error"
                    )
                  : "vacio" == e &&
                    Swal.fire("Error!", "Datos vacíos", "error");
            })
        : Swal.fire(
            "Aviso!",
            "La contraseña debe de tener al menos 8 carácteres",
            "warning"
          )
      : Swal.fire(
          "Aviso!",
          "El correo debe tener formato de email (@example.com)",
          "warning"
        );
  });
}
function validarSoloLetras(e) {
  return !!/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ.]*$/.test(e);
}
function validarCorreo(e) {
  return !!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(e);
}
const typed = new Typed(".descripcion", {
  stringsElement: "#maquina",
  typeSpeed: 75,
  startDelay: 300,
  backSpeed: 75,
  smartBackspace: !0,
  shuffle: !1,
  backDelay: 1500,
  loop: !0,
  loopCount: !1,
  showCursor: !0,
  cursorChar: "|",
  contentType: "html",
});
