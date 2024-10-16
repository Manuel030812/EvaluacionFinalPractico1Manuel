<?php
// eliminar.php
if (isset($_POST['idp'])) {
    include('conexion.php');
    $con = conectaDB();

    $idproducto = $_POST['idp'];
    $sql = "DELETE FROM tb_productos WHERE idPro = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $idproducto); // 's' para string

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => 1, 'message' => 'Producto eliminado correctamente.']);
    } else {
        echo json_encode(['success' => 0, 'message' => 'Error al eliminar el producto: ' . mysqli_error($con)]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo json_encode(['success' => 0, 'message' => 'No se recibió un ID de producto válido.']);
}
?>
