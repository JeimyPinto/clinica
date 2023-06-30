<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar la habitación de la base de datos
    $sql_delete = "DELETE FROM habitaciones WHERE id = ?";
    $stmt_delete = mysqli_prepare($con, $sql_delete);
    if ($stmt_delete) {
        mysqli_stmt_bind_param($stmt_delete, "i", $id);
        $result_delete = mysqli_stmt_execute($stmt_delete);

        if ($result_delete) {
            echo "La habitación se ha eliminado correctamente de la base de datos.";
            header("Location: registro_habitaciones.php");
            exit();
        } else {
            echo "Error al eliminar la habitación de la base de datos: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt_delete);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($con);
    }
} else {
    echo "ID de habitación no especificado.";
}
?>
