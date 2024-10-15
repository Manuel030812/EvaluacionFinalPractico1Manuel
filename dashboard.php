<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: index.php");
}
?>
<html>
<head>
    <title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
    <link href="css/cmce-styles.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?> [<?php echo $_SESSION['NombreCompleto']; ?>]</a>
        <a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
    </div>
</nav>
<center>
    <br><br><br><br>

    <form action="dashboard.php" method="GET">
        <div class="formpanel" id="f1">
            <b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <br><br>
    <hr>
    <br><br>

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nuevo Producto
    </button>

    <br><br>
    <?php
    include('controller/conexion.php');
    $con = conectaDB();
    if (isset($_GET['pre']) == true)
        $sql = "select idPro, Nombre, Precio from tb_productos where Precio > " . $_GET['pre'];
    else
        $sql = "select idPro, Nombre, Precio from tb_productos";

    echo "<table class='table' style='width:570;'>";
    echo "<thead class='table-dark'>";
    echo "<th>Nombre</th>";
    echo "<th>Precio</th>";
    echo "<th>Acciones</th>";
    echo "</thead>";
    echo "<tbody>";

    $resultado = mysqli_query($con, $sql);
    while ($fila = mysqli_fetch_row($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila[1] . "</td>";
        echo "<td>" . $fila[2] . "</td>";
        // Aquí añadimos el botón de editar y eliminar
        echo "<td>
                <button class='btn btn-warning btn-sm' onclick='editarProducto(" . $fila[0] . ")'>Editar</button>
                <a href='controller/eliminar.php?idp=" . $fila[0] . "'><img src='iconoeliminar.png' width='20' heigth='20'></a>
              </td>";
        echo "</tr>";
    }

    echo "</tbody> </table>";
    ?>
    <br><br>

    <!-- Modal Ventana de Nuevo Producto -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="nuevoProductoForm">
                        <div class="mb-3">
                            <label for="Nombre" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control" id="Nombre" name="Nombre" maxlength="150" required>
                        </div>
                        <div class="mb-3">
                            <label for="Precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="Precio" name="Precio" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="Ext" class="form-label">Existencias</label>
                            <input type="number" class="form-control" id="Ext" name="Ext" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="guardarProducto">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Modal Ventana de Editar Producto -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editarProductoForm">
                        <input type="hidden" id="idPro" name="idPro">
                        <div class="mb-3">
                            <label for="NombreEditar" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control" id="NombreEditar" name="Nombre" maxlength="150" required>
                        </div>
                        <div class="mb-3">
                            <label for="PrecioEditar" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="PrecioEditar" name="Precio" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="ExtEditar" class="form-label">Existencias</label>
                            <input type="number" class="form-control" id="ExtEditar" name="Ext" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="guardarEdicion">Guardar Edición</button>
                </div>
            </form>
            </div>
        </div>
    </div>

</center>

<!-- Footer -->
<footer class="footer bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white"><b> UC: Desarrollo de aplicaciones web y móviles [ Dr. Christian Mauricio Castillo Estrada ] </b></p>
    </div>
</footer>
<script src="js/agregar.js"></script>
<script src="js/editar.js"></script>
<script src="js/buscar.js"></script>
<script src="js/modificar.js"></script>
</body>
</html>
