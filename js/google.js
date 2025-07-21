var googleUser = {},
  startApp = function () {
    gapi.load("auth2", function () {
      (auth2 = gapi.auth2.init({
        client_id:
          "730299540814-rlig2827vgivsnfoiaspofd77vpjba1h.apps.googleusercontent.com",
        cookiepolicy: "single_host_origin",
        scope: "profile email",
      })),
        attachSignin(document.getElementById("google"));
    });
  };
function attachSignin(e) {
  auth2.attachClickHandler(e, {}, function (e) {
    const i = e.getBasicProfile(),
      o = {
        first_name: i.getGivenName(),
        last_name: i.getFamilyName(),
        picture: i.getImageUrl(),
        email: i.getEmail(),
        red: "google",
      };
    fetch("php/google.php", {
      method: "POST",
      body: JSON.stringify(o),
      headers: { "Content-type": "aplication/json" },
    })
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
        } else if ("error" == e)
          Swal.fire("Error!", "Error en el servidor", "error");
        else if ("admin" == e) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Bienvenido a su panel de administrador",
            showConfirmButton: !1,
            timer: 1500,
          }),
            setTimeout(function () {
              location.href =
                "https://cocinas-aurora.herokuapp.com/control_panel/";
            }, 500);
        }
      });
  });
}
startApp();
