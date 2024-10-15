$(document).ready(function() {
    // Evento click para el botón "Guardar Edición"
    $('#guardarEdicion').click(function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del botón

        // Obtener los valores de los campos
        var idPro = $('#idPro').val();
        var nombre = $('#NombreEditar').val();
        var precio = $('#PrecioEditar').val();
        var existencias = $('#ExtEditar').val();

        // Validación de campos
        if (nombre === "" || precio === "" || existencias === "") {
            alert("Todos los campos son obligatorios.");
            return;
        }

        // Validar que precio y existencias sean números válidos
        if (isNaN(precio) || isNaN(existencias) || precio <= 0 || existencias < 0) {
            alert("Precio y existencias deben ser números válidos.");
            return;
        }

        // Enviar los datos mediante AJAX
        console.log("idPro:", idPro, "Nombre:", nombre, "Precio:", precio, "Existencias:", existencias);

        $.ajax({
            
            url: 'controller/modificar.php',
            type: 'POST',
            data: {
                idPro: idPro,
                Nombre: nombre,
                Precio: precio,
                Ext: existencias
            },
            
            success: function(response) {
                if (response.trim() === 'success') {
                    alert("Producto actualizado correctamente.");
                    location.reload(); // Recargar la página para mostrar los cambios
                } else if (response.trim() === 'no_changes') {
                    alert("No se realizaron cambios en el producto.");
                    location.reload(); // Opcional, dependiendo de tu necesidad
                } else {
                    alert("Error al actualizar el producto: " + response); // Mostrar el mensaje de error detallado
                }
            }
            
        });
    });
});
