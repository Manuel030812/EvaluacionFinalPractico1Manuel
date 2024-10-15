$(document).ready(function() {
    $('#buscarProductoForm').on('submit', function(event) {
        event.preventDefault(); // Prevenir que se envíe el formulario de forma convencional

        var nombre = $('#nombreProducto').val(); // Obtener el nombre del producto

        $.ajax({
            url: 'controller/buscar.php', // URL del script PHP
            type: 'GET',
            data: { nombre: nombre }, // Pasar el nombre del producto como parámetro
            dataType: 'json',
            success: function(data) {
                // Limpiar la tabla actual
                $('tbody').empty();

                // Verificar si hay resultados
                if (data.length === 0) {
                    $('tbody').append('<tr><td colspan="3">No se encontraron productos.</td></tr>');
                } else {
                    // Agregar los resultados a la tabla
                    $.each(data, function(index, producto) {
                        $('tbody').append(
                            '<tr>' +
                            '<td>' + producto.Nombre + '</td>' +
                            '<td>' + producto.Precio + '</td>' +
                            '<td><a href="controller/eliminar.php?idp=' + producto.idPro + '"><img src="iconoeliminar.png" width="20" heigth="20"></a></td>' +
                            '</tr>'
                        );
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Mostrar errores en la consola
                alert('Error en la búsqueda.'); // Mensaje de error
            }
        });
    });
});
