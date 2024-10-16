$(document).ready(function() {
    // Capturar el clic en los enlaces o botones de eliminar
    $('tbody').on('click', '.btn-eliminar', function(event) {
        event.preventDefault(); // Evitar la acción por defecto del enlace

        var idProducto = $(this).data('id'); // Obtener el ID del producto desde el atributo data

        // Confirmar antes de eliminar
        if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
            // Enviar solicitud AJAX
            $.ajax({
                url: 'controller/eliminar.php',
                type: 'POST',
                data: { idp: idProducto }, // Pasar el ID del producto
                dataType: 'json',
                success: function(response) {
                    if (response.success === 1) {
                        alert(response.message); // Mostrar mensaje de éxito
                        location.reload();
                        // Remover la fila del producto eliminado de la tabla
                        $('#producto-' + idProducto).remove();
                    } else {
                        alert('Error: ' + response.message); // Mostrar mensaje de error
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Mostrar errores en la consola
                    alert('Error al intentar eliminar el producto.');
                }
            });
        }
    });
});
