$(document).ready(function() {
    // Escuchar el clic del botón de inicio de sesión
    $('#login').on('click', function() {
        login();
    });
});

// Función para iniciar sesión
function login() {
    var loginUsername = $('#loginUsername').val();
    var loginPassword = $('#loginPassword').val();

    $.ajax({
        url: 'controller/validar.php',
        method: 'POST',
        data: {
            loginUsername: loginUsername,
            loginPassword: loginPassword,
        },
        success: function(data) {
            var jsonData = JSON.parse(data);
            
            if (jsonData.success == 1) {
                // Redirigir al dashboard si la autenticación es exitosa
                window.location = 'dashboard.php';
            } else {
                // Mostrar el mensaje de error
                var msg_alerta = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    jsonData.message + 
                    '</div>';
                $('#loginMessage').html(msg_alerta);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Mostrar mensaje de error si la llamada AJAX falla
            var msg_alerta = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                'Error al realizar la solicitud: ' + textStatus + ' - ' + errorThrown + 
                '</div>';
            $('#loginMessage').html(msg_alerta);
        }
    });
}
