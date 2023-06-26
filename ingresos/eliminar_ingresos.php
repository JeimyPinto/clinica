<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si el ingreso existe antes de eliminarlo
    $sql_check = "SELECT * FROM ingresos WHERE id = ?";
    $stmt_check = mysqli_prepare($con, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "i", $id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        // El ingreso existe, procedemos a eliminarlo
        $sql_delete = "DELETE FROM ingresos WHERE id = ?";
        $stmt_delete = mysqli_prepare($con, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "i", $id);
        $result_delete = mysqli_stmt_execute($stmt_delete);

        if ($result_delete) {
            echo "El ingreso ha sido eliminado correctamente.";
            header("Location: registro_ingresos.php");

        } else {
            echo "Error al eliminar el ingreso: " . mysqli_error($con);
        }
    } else {
        echo "El ingreso no existe.";
    }

    mysqli_stmt_close($stmt_check);
    mysqli_stmt_close($stmt_delete);
}

mysqli_close($con);
?>