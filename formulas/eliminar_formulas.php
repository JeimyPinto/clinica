<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Eliminar la fórmula de la base de datos
        $sql = "DELETE FROM formulas WHERE id = '$id'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: registro_formulas.php");
        } else {
            echo "Error al eliminar la fórmula.";
        }
    } else {
        echo "ID de fórmula no especificado.";
    }
}
?>