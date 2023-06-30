<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realizar la eliminación del medicamento
    $sql = "DELETE FROM medicamentos WHERE id = ?";
    $query = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($query, 'i', $id);

    if (mysqli_stmt_execute($query)) {
        // Redirigir a la página de registro de medicamentos
        header("Location: registro_medicamentos.php");
        exit;
    } else {
        echo "Error al eliminar el medicamento: " . mysqli_stmt_error($query);
    }

    mysqli_stmt_close($query);
} else {
    echo "ID de medicamento no proporcionado.";
}
?>
