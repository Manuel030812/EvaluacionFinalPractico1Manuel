$(document).ready(function() {
    // Evento al hacer clic en el botón guardar
    $('#guardarProducto').on('click', function(){
        // Obtenemos los valores del formulario
        var nombre = $('#Nombre').val();
        var precio = $('#Precio').val();
        var ext = $('#Ext').val();
        
        // Validar que no estén vacíos
        if (nombre != "" && precio != "" && ext != "") {
            $.ajax({
                url: 'controller/agregar.php',  // Archivo PHP que procesará los datos
                type: 'POST',
                data: {
                    Nombre: nombre,
                    Precio: precio,
                    Ext: ext
                },
                success: function(response) {
                    // Manejo de respuesta
                    var jsonData = JSON.parse(response);

                    if (jsonData.success == "1") {
                        // Producto guardado exitosamente
                        alert("Producto guardado correctamente.");
                        // Recargar la página para ver los nuevos datos
                        location.reload();
                    } else {
                        // Error al guardar
                        alert("Error al guardar el producto.");
                    }
                }
            });
        } else {
            alert("Por favor completa todos los campos.");
        }
    });
});
