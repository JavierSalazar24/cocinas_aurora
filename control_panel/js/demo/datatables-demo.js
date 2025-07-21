$(document).ready(function () {
  $("#dataTable").DataTable({
    order: [[1, "asc"]],
    language: {
      lengthMenu: "Mostrar _MENU_ registros por página",
      info: "Mostrando página _PAGE_ de _PAGES_",
      infoEmpty: "No hay registros disponibles",
      infoFiltered: "(Filtrada de _MAX_ registros)",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "No se encontraron registros coincidentes",
      paginate: {
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    responsive: "true",
    dom: "lfrtipB",
    buttons: [
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i>',
        titleAttr: "Exportar a Excel",
        className: "btn-excel",
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fas fa-file-pdf"></i>',
        titleAttr: "Exportar a PDF",
        className: "btn-pdf",
      },
      {
        extend: "print",
        text: '<i class="fas fa-print"></i>',
        titleAttr: "Imprimir",
        className: "btn-imprimir",
      },
    ],
  });
});
