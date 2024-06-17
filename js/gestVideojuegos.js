$(document).ready(function(){
    $('#modalEliminarVideojuego').on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget);
        let id = button.data('id');
        $('#eliminarId').val(id);
    });

    $('#modalEditarVideojuego').on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget);
        let formData = new FormData();
        let id = button.data('id');
        formData.append('id', id);
        formData.append('accion', 'obtener_videojuego');

        $.ajax({
            url: 'acciones/acciones.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false, 
            processData: false,
            success: function (response) {
                console.log(response);
                $('#editarId').val(response.id);
                $('#editarTitulo').val(response.titulo);
                $('#editarSinopsis').val(response.sinopsis);
                $('#editarPrecio').val(response.precio);
                $('#editarFechaLanzamiento').val(response.fecha_lanzamiento);
                $('#editarCategorias').val(response.categorias_id);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    $('#form-videojuego-eliminar').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('accion', 'borrar_videojuego')
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

    $('#form-crear-videojuego').submit(function(e){
        e.preventDefault();
    
        let formData = new FormData(this);
        formData.append('accion', 'crear_videojuego');
    
        $.ajax({
            type: 'POST',
            url: 'acciones/acciones.php',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
    
                location.reload();
            },
            error: function(response) {
                console.error('Error al crear videojuego:', response);
            }
        });
    });

    $('#formEditarVideojuego').submit(function(e){
        e.preventDefault();
    
        let formData = new FormData(this);
        formData.append('accion', 'editar_videojuego');
    
        $.ajax({
            type: 'POST',
            url: 'acciones/acciones.php',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
    
                location.reload();
            },
            error: function(response) {
                console.error('Error al editar videojuego:', response);
            }
        });
    });
})