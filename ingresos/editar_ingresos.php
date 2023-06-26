<?php
include("../connection/connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del ingreso a editar
    $sql_select = "SELECT * FROM ingresos WHERE id = ?";
    $stmt_select = mysqli_prepare($con, $sql_select);
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);

    if (mysqli_num_rows($result_select) > 0) {
        $row = mysqli_fetch_assoc($result_select);
        $id = $row['id'];
        $pacienteID = $row['pacienteID'];
        $fechaIngreso = $row['fechaIngreso'];
        $diagnostico = $row['diagnostico'];
    } else {
        echo "El ingreso no existe.";
        exit();
    }

    mysqli_stmt_close($stmt_select);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y obtener los datos enviados por el formulario
    $id = $_POST['id'];
    $pacienteID = $_POST['pacienteID'];
    $fechaIngreso = $_POST['fechaIngreso'];
    $diagnostico = $_POST['diagnostico'];

    // Actualizar los datos del ingreso en la base de datos
    $sql_update = "UPDATE ingresos SET pacienteID = ?, fechaIngreso = ?, diagnostico = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($con, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "issi", $pacienteID, $fechaIngreso, $diagnostico, $id);
    $result_update = mysqli_stmt_execute($stmt_update);

    if ($result_update) {
        echo "Los cambios se han guardado correctamente.";
        header("Location: registro_ingresos.php");
        exit();
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt_update);
}

// Obtener los nombres de los pacientes
$sql_pacientes = "SELECT id, nombre FROM pacientes";
$query_pacientes = mysqli_query($con, $sql_pacientes);
$pacientes = array();
while ($row_paciente = mysqli_fetch_assoc($query_pacientes)) {
    $pacientes[$row_paciente['id']] = $row_paciente['nombre'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ingreso</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>

<body>
    <div class="form_container">
        <form action="" method="POST">
            <h1>Editar Ingreso</h1>
            <input class="form_input" type="number" name="id" placeholder="Id del Ingreso" value="<?= $id ?>" required
                readonly>
            <select class="form_input" name="pacienteID" required>
                <option value="">Seleccione un paciente</option>
                <?php
                foreach ($pacientes as $pacienteID => $nombre) {
                    $selected = ($pacienteID == $row['pacienteID']) ? "selected" : "";
                    echo '<option value="' . $pacienteID . '" ' . $selected . '>' . $nombre . '</option>';
                }
                ?>
            </select>
            <input class="form_input" type="date" name="fechaIngreso" placeholder="Fecha de ingreso"
                value="<?= $fechaIngreso ?>" required>
            <input class="form_input" type="text" name="diagnostico" placeholder="Diagnóstico"
                value="<?= $diagnostico ?>" required>
            <input class="form_submit" type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>

</html>