<?php
include('../conexion.php'); // Asegúrate de incluir la conexión a la base de datos
$con = conectaDB();

if (isset($_GET['precio'])) {
    // Escapar la entrada del usuario para evitar inyecciones SQL
    $precio = mysqli_real_escape_string($con, $_GET['precio']);
    
    // Modificar la consulta para buscar productos con precio mayor o igual al valor ingresado
    $sql = "SELECT idPro, Nombre, Precio FROM tb_productos WHERE Precio >= $precio";
    $resultado = mysqli_query($con, $sql);
    
    // Crear un array para almacenar los productos
    $productos = array();
    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila; // Almacenar cada producto en el array
    }
    
    // Devolver los resultados como JSON
    echo json_encode($productos);
} else {
    echo json_encode(array()); // Si no se pasa un precio, devolver un array vacío
}

mysqli_close($con); // Cerrar la conexión
?>
