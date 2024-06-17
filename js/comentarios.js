$(document).ready(function () {
  $("#formComentarios").submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append("accion", "crear_comentario");
    $.ajax({
      type: "POST",
      url: "acciones/acciones.php",
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        location.reload();
      },
      error: function (response) {
        console.log(response);
      },
    });
  });

    $('.megusta').click(function(e){
        const button = this;

        const comentarioId = button.getAttribute('data-id-comentario');
        const likeado = button.getAttribute('data-likeado') === 'true';
        const numLikesSpan = $('#comentario'+comentarioId);

        let formData = new FormData();
        formData.append("accion", "controlar_likes");
        formData.append("likeado", likeado);
        formData.append("comentario_id", comentarioId);

        $.ajax({
          type: "POST",
          url: "acciones/acciones.php",
          data: formData,
          dataType: "json",
          contentType: false,
          processData: false,
          success: function (response) {
            button.setAttribute("data-likeado", !likeado);
            button.textContent = !likeado ? "Quitar Me gusta 👎" : "Me gusta 👍";

            const numLikes = parseInt(numLikesSpan.text(), 10);
            numLikesSpan.text(!likeado ? numLikes + 1 : numLikes - 1);
          },
          error: function (response) {
            console.log(response);
          },
        });
    });

    $('.borrarComentario').click(function(e){
        const button = this;
        const comentarioId = button.getAttribute('data-id-comentario');
    
        let formData = new FormData();
        formData.append("accion", "borrar_comentario");
        formData.append("comentario_id", comentarioId);
    
        $.ajax({
            type: "POST",
            url: "acciones/acciones.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                $(button).closest('.media').remove(); // Elimina el comentario.
    
                console.log("Comentario eliminado exitosamente");
            },
            error: function (response) {
                console.log(response);
            },
        });
    });

    
    
});
