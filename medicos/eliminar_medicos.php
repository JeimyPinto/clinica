<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Eliminar el médico de la base de datos
        $sql = "DELETE FROM medicos WHERE id = '$id'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: registro_medicos.php");
        } else {
            echo "Error al eliminar la fórmula.";
        }
    } else {
        echo "ID de consulta no especificado.";
    }
}
?>