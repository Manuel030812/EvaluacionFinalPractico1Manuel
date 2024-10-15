<?php
include('conexion.php');
$con = conectaDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados
    $idPro = $_POST['idPro'];
    $nombre = $_POST['Nombre'];
    $precio = $_POST['Precio'];
    $existencias = $_POST['Ext'];

    // Validar que todos los datos estén presentes
    if (empty($idPro) || empty($nombre) || empty($precio) || empty($existencias)) {
        echo 'error'; // Puedes manejar el error de otra forma
        exit;
    }

    // Preparar la consulta de actualización
    $sql = "UPDATE tb_productos SET Nombre = ?, Precio = ?, Ext = ? WHERE idPro = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sdii', $nombre, $precio, $existencias, $idPro);
        mysqli_stmt_execute($stmt);
        
        // Verificar el resultado de la actualización
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        
        if ($affected_rows > 0) {
            echo 'success'; // Actualización exitosa
        } else {
            echo 'no_changes'; // No se realizó ninguna actualización (puede ser que no haya cambios)
        }

        mysqli_stmt_close($stmt);
    } else {
        echo 'prepare_error'; // Error en la preparación de la consulta
    }
} else {
    echo 'invalid_request'; // Solicitud no válida
}

mysqli_close($con);
?>
