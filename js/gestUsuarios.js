$(document).ready(function() {
    // Rellenar formulario de edición al abrir el modal
    $('#modalEditarUsuario').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        let formData = new FormData();
        var id = button.data('id');
        formData.append('id', id);
        formData.append('accion', 'obtener_usuario');

        $.ajax({
            url: 'acciones/acciones.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                $('#editarId').val(response.id);
                $('#editarUsername').val(response.username);
                $('#editarCorreo').val(response.email);
                $('#editarRol').val(response.rol);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    // Rellenar campo de ID al abrir el modal de eliminación
    $('#modalEliminarUsuario').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        $('#eliminarId').val(id);
    });


    // Enviar formulario de edición
    $('#formEditarUsuario').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('accion', 'editar_usuario');

        $.ajax({
            url: 'acciones/acciones.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                $('#modalEditarUsuario').modal('hide');
                location.reload();
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    // Enviar formulario de eliminación
    $('#formEliminarUsuario').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('accion', 'eliminar_usuario');

        $.ajax({
            url: 'acciones/acciones.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                $('#modalEliminarUsuario').modal('hide');
                location.reload();
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
});