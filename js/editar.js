function editarProducto(id) {
    $.ajax({
        url: 'controller/consultar.php', // Asegúrate de crear este archivo
        type: 'GET',
        data: { id: id },
        success: function(data) {
            var producto = JSON.parse(data);
            $('#idPro').val(producto.idPro);
            $('#NombreEditar').val(producto.Nombre);
            $('#PrecioEditar').val(producto.Precio);
            $('#ExtEditar').val(producto.Ext);
            $('#editarModal').modal('show');
        },
        error: function() {
            alert('Error al obtener los datos del producto.');
        }
    });
}
