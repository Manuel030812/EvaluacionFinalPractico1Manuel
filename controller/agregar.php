<?php
include('conexion.php');
$con = conectaDB();

// Verificar que los datos hayan sido enviados por POST
if(isset($_POST['Nombre']) && isset($_POST['Precio']) && isset($_POST['Ext'])) {
    $nombre = $_POST['Nombre'];
    $precio = $_POST['Precio'];
    $ext = $_POST['Ext'];
    
    // Insertar los datos en la tabla tb_productos
    $sql = "INSERT INTO tb_productos (Nombre, Precio, Ext) VALUES ('$nombre', '$precio', '$ext')";
    
    if (mysqli_query($con, $sql)) {
        echo json_encode(array('success' => 1));  // Éxito
    } else {
        echo json_encode(array('success' => 0));  // Error en la inserción
    }
} else {
    echo json_encode(array('success' => 0));  // Error en los datos recibidos
}

mysqli_close($con);
?>
