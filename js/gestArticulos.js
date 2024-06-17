$(document).ready(function() {
  $("#formAgregarArticulo").submit(function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    let formData = new FormData(this);
    formData.append("accion", "crear_articulo");
    $.ajax({
      type: "POST",
      url: "acciones/acciones.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);

        location.reload();
      },
      error: function (response) {
        console.error(response);
      },
    });
  });

  // Cargar datos del artículo en el modal de edición
  $("#modalEditarArticulo").on("show.bs.modal", function (e) {
    let button = $(e.relatedTarget);
    let id = button.data("id");
    let formData = new FormData();
    formData.append('id', id);
    formData.append('accion', 'obtener_articulo');

    $.ajax({
      url: "acciones/acciones.php",
      type: "POST",
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        $("#editarArticuloId").val(response.id);
        $("#editarTitulo").val(response.titulo);
        $("#editarResumen").val(response.resumen);
        $("#editarContenido").val(response.contenido);
        $("#editarCategoria").val(response.categoria_id);
        $("#editarVideojuego").val(response.videojuego_id);
      },
      error: function (response) {
        console.log(response);
      },
    });
  });

  $("#formEditarArticulo").submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("accion", "editar_articulo");
    $.ajax({
      url: "acciones/acciones.php",
      type: "POST",
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          console.log(response.message);
          location.reload();
        } else {
          console.log("Error: " + response.message);
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });

  $("#modalEliminarArticulo").on("show.bs.modal", function (e) {
    let button = $(e.relatedTarget);
    let id = button.data("id");
    $("#eliminarId").val(id);
  });

  $('#form-articulo-eliminar').submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);
    formData.append('accion', 'borrar_articulo')
    $.ajax({
        url: 'acciones/acciones.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (e) {
            $('#modalEliminarVideojuego').modal('hide');
            location.reload();
        },
        error: function (e) {
            console.error(e);
        }
    });
});

});
