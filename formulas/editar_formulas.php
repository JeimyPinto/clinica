<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['pacienteID']) && isset($_POST['medicoID']) && isset($_POST['fechaFormula'])) {
        $id = $_POST['id'];
        $pacienteID = $_POST['pacienteID'];
        $medicoID = $_POST['medicoID'];
        $fechaFormula = $_POST['fechaFormula'];

        // Realizar la actualización en la base de datos con los nuevos valores
        $sql = "UPDATE formulas SET pacienteId = '$pacienteID', medicoId = '$medicoID', fechaFormula = '$fechaFormula' WHERE id = '$id'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: registro_formulas.php");
        } else {
            echo "Error al actualizar la fórmula.";
        }
    } else {
        echo "No se enviaron todos los datos necesarios.";
    }
} else {
    // Obtener el ID de la fórmula a editar desde la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Obtener los datos de la fórmula específica
        $sql = "SELECT * FROM formulas WHERE id = '$id'";
        $query = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($query);

        // Obtener listado de pacientes
        $pacienteSql = "SELECT id, nombre FROM pacientes";
        $pacienteQuery = mysqli_query($con, $pacienteSql);
        $pacientes = array();
        while ($pacienteRow = mysqli_fetch_assoc($pacienteQuery)) {
            $pacientes[$pacienteRow['id']] = $pacienteRow['nombre'];
        }

        // Obtener listado de médicos
        $medicoSql = "SELECT id, nombre FROM medicos";
        $medicoQuery = mysqli_query($con, $medicoSql);
        $medicos = array();
        while ($medicoRow = mysqli_fetch_assoc($medicoQuery)) {
            $medicos[$medicoRow['id']] = $medicoRow['nombre'];
        }
    } else {
        echo "ID de fórmula no especificado.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fórmula</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_group">
        <form action="" method="POST" class="form">
            <h1 class="form_title">Editar Fórmula</h1>
            <input class="form_input" type="number" name="id" value="<?= $row['id'] ?>" readonly>

            <select class="form_input" name="pacienteID" required>
                <?php
                foreach ($pacientes as $id => $nombre) {
                    $selected = ($id == $row['pacienteId']) ? "selected" : "";
                    echo "<option value='$id' $selected>$nombre</option>";
                }
                ?>
            </select>

            <select class="form_input" name="medicoID" required>
                <?php
                foreach ($medicos as $id => $nombre) {
                    $selected = ($id == $row['medicoId']) ? "selected" : "";
                    echo "<option value='$id' $selected>$nombre</option>";
                }
                ?>
            </select>

            <input class="form_input" type="date" name="fechaFormula" value="<?= $row['fechaFormula'] ?>" required>
            <input class="form_submit" type="submit" value="Guardar Cambios">
        </form>
    </div>

    <div>
        <a href="registro_formulas.php" class="form_link">Volver</a>
    </div>
</body>

</html>