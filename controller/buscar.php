<?php
include('conexion.php'); // Asegúrate de incluir la conexión a la base de datos
$con = conectaDB();

if (isset($_GET['nombre'])) {
    $nombre = mysqli_real_escape_string($con, $_GET['nombre']);
    
    $sql = "SELECT idPro, Nombre, Precio FROM tb_productos WHERE Nombre LIKE '%$nombre%'";
    $resultado = mysqli_query($con, $sql);
    
    $productos = array();
    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila; // Almacenar cada producto en el array
    }
    
    // Devolver los resultados como JSON
    echo json_encode($productos);
} else {
    echo json_encode(array()); // Si no hay nombre, devolver un array vacío
}

mysqli_close($con); // Cerrar la conexión
?>
