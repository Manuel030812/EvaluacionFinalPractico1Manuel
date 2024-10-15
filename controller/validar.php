<?php
session_start();
include('conexion.php');

$con = conectaDB();

// Verificar si se recibieron los datos
if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Consulta para obtener el usuario
    $sql = "SELECT NomUser, NombreCompleto FROM tb_usuarios WHERE NomUser = ? AND Passwd = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['login'] = true;
            $_SESSION['nomusuario'] = $username;
            $_SESSION['NombreCompleto'] = $row['NombreCompleto'];
            echo json_encode(['success' => 1]);
        } else {
            echo json_encode(['success' => 0, 'message' => 'Usuario o contraseña incorrectos.']);
        }
    } else {
        echo json_encode(['success' => 0, 'message' => 'Error en la consulta.']);
    }
} else {
    echo json_encode(['success' => 0, 'message' => 'Datos no recibidos.']);
}
?>
