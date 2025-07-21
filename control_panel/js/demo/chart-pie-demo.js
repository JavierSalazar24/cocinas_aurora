// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

$.ajax({
  url: "php/consulta_estadisticas.php",
  type: "POST",
}).done(function (resp) {
  let contenido = resp.split("");
  let admins = parseInt(contenido[1]);
  let clientes = parseInt(contenido[2]);
  let ventas = parseInt(contenido[3]);
  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: ["Administradores", "Clientes", "Ventas"],
      datasets: [
        {
          data: [admins, clientes, ventas],
          backgroundColor: ["#4e73df", "#1cc88a", "#f6c23e"],
          hoverBackgroundColor: ["#2e59d9", "#17a673", "#f2ad2f"],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: "#dddfeb",
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false,
      },
      cutoutPercentage: 80,
    },
  });
});
