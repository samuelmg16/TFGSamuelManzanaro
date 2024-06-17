$(document).ready(function(){
    $('#formIniciarSesion').submit(function(e){
        e.preventDefault();

        let formData = new FormData(this);

        formData.append('accion', 'iniciar_sesion');

        $.ajax({
            type: 'POST',
            url: 'acciones/acciones.php', 
            data: formData, 
            dataType: 'json',
            contentType: false, 
            processData: false,
            success: function(response) {
                if(response.success == true){
                    location.reload();
                } else {
                    $('#loginError').text(response.message);
                }
            },
            error: function(response) {
                console.log(response);
                $('#loginError').text(response.message);
            }

        });
    });

    $('#loginModal').on('hidden.bs.modal', function () {
        $('#loginError').text(''); // Limpiamos el contenido del elemento #loginError
    });

    $('#formRegistro').submit(function(e){
        e.preventDefault();
    
        // Obtenemos los valores de los campos
        let username = $('#username_registro').val().trim();
        let email = $('#registerEmail').val().trim();
        let password = $('#registerPassword').val();
        let confirm_password = $('#registerPasswordConfirm').val();
        // Expresión regular para validar que el username empiece por una letra
        let usernameRegex = /^[A-Za-z][A-Za-z0-9_]*$/;
        // Limpiamos mensajes de error anteriores
        $('.error-message').text('');
    
        // Expresión regular para validar el formato del email
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
        // Validamos que todos los campos estén completos y correctos
        let valid = true;
    
        if (username === '') {
            $('#error-username').text('El nombre de usuario es obligatorio');
            valid = false;
        } else if (username.length < 4) {
            $('#error-username').text('El nombre de usuario debe tener al menos 4 caracteres');
            valid = false;
        } else if (!usernameRegex.test(username)) {
            $('#error-username').text('El nombre de usuario debe empezar por una letra');
            valid = false;
        }
    
        if (email === '') {
            $('#error-email').text('El correo electrónico es obligatorio');
            valid = false;
        } else if (!emailRegex.test(email)) {
            $('#error-email').text('El correo electrónico no tiene un formato válido');
            valid = false;
        }
    
        if (password === '') {
            $('#error-password').text('La contraseña es obligatoria');
            valid = false;
        } else if (password.length < 6) {
            $('#error-password').text('La contraseña debe tener al menos 6 caracteres');
            valid = false;
        } else if (!/[a-zA-Z]/.test(password) || !/[0-9]/.test(password)) {
            $('#error-password').text('La contraseña debe contener letras y números');
            valid = false;
        }
    
        if (confirm_password === '') {
            $('#error-confirm-password').text('Debes confirmar la contraseña');
            valid = false;
        } else if (confirm_password !== password) {
            $('#error-confirm-password').text('Las contraseñas no coinciden');
            valid = false;
        }
    
        // Si todos los campos son válidos, llamamos a la acción registrar_usuario
        if (valid) {
            let formData = new FormData(this);
    
            formData.append('accion', 'registrar_usuario');
    
            $.ajax({
                type: 'POST',
                url: 'acciones/acciones.php', 
                data: formData, 
                dataType: 'json',
                contentType: false, 
                processData: false,
                success: function(response) {
                    if(response.success == true){
                        location.reload();
                    } else {
                        $('#registerError').text(response.message);
                    }
                },
                error: function(response) {
                    console.log(response);
                    $('#registerError').text(response.message);
                }
    
            });
        }
    });

    $('#btn_cerrar_sesion').click(function(e){
        e.preventDefault();
        let formData = new FormData();
        formData.append('accion', 'cerrar_sesion');
        $.ajax({
            type: 'POST',
            url: 'acciones/acciones.php', 
            data: formData, 
            dataType: 'json',
            contentType: false, 
            processData: false,
            success: function(response) {
                location.reload();
            },
            error: function(response) {
                console.log(response);
            }

        });
    });

})