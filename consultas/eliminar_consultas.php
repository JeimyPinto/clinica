<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Eliminar la consulta de la base de datos
        $sql = "DELETE FROM consultas WHERE id = '$id'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: registro_consultas.php");
        } else {
            echo "Error al eliminar la fórmula.";
        }
    } else {
        echo "ID de consulta no especificado.";
    }
}
?>