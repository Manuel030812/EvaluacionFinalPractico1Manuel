<?php
// eliminar.php
if (isset($_GET['idp'])) {
    include('conexion.php');
    $con = conectaDB();

    $idproducto = $_GET['idp'];
    $sql = "DELETE FROM tb_productos WHERE idPro = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $idproducto); // 's' para string

    if (mysqli_stmt_execute($stmt)) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);

    // Redirigir al index después de eliminar
    header('Location: /EvaluacionFinalPractico1Manuel/dashboard.php');
    exit();
} else {
    echo "No se recibió un ID de producto válido.";
}
?>
