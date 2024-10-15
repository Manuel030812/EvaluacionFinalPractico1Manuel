<?php
include('conexion.php');
$con = conectaDB();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT idPro, Nombre, Precio, Ext FROM tb_productos WHERE idPro = $id";
    $resultado = mysqli_query($con, $sql);

    if ($resultado) {
        $producto = mysqli_fetch_assoc($resultado);
        echo json_encode($producto);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID no especificado']);
}
