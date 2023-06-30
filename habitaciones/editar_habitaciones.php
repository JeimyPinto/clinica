<?php
include("../connection/connection.php");

$con = connection();

$id = $_GET['id'] ?? '';

// Obtener los datos de la habitación específica
$sql_select = "SELECT * FROM habitaciones WHERE id = ?";
$stmt_select = mysqli_prepare($con, $sql_select);
if ($stmt_select) {
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    $row = mysqli_fetch_assoc($result_select);

    if ($row) {
        // Datos de la habitación
        $numero = $row['numero'];
        $tipo = $row['tipo'];
        $piso = $row['piso'];
        $ocupada = $row['ocupada'];

        // Verificar si se ha enviado el formulario de edición
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos actualizados del formulario
            $numero_actualizado = $_POST['numero'];
            $tipo_actualizado = $_POST['tipo'];
            $piso_actualizado = $_POST['piso'];
            $ocupada_actualizado = $_POST['ocupada'];

            // Convertir la opción del select a 0 o 1
            $ocupada_actualizado = ($ocupada_actualizado == "Disponible") ? 0 : 1;

            // Actualizar los datos en la base de datos
            $sql_update = "UPDATE habitaciones SET numero = ?, tipo = ?, piso = ?, ocupada = ? WHERE id = ?";
            $stmt_update = mysqli_prepare($con, $sql_update);
            if ($stmt_update) {
                mysqli_stmt_bind_param($stmt_update, "issii", $numero_actualizado, $tipo_actualizado, $piso_actualizado, $ocupada_actualizado, $id);
                $result_update = mysqli_stmt_execute($stmt_update);

                if ($result_update) {
                    echo "Los datos se han actualizado correctamente en la base de datos.";
                    // Redireccionar a registro_habitaciones.php
                    header("Location: registro_habitaciones.php");
                    exit();
                } else {
                    echo "Error al actualizar los datos en la base de datos: " . mysqli_error($con);
                }
                mysqli_stmt_close($stmt_update);
            }
        }
    } else {
        echo "No se encontró una habitación con el ID especificado.";
    }
    mysqli_stmt_close($stmt_select);
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Habitación</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_container form_group">
        <form action="" method="POST" class="form">
            <h1>Editar Habitación</h1>
            <input type="text" class="form_input" name="id" placeholder="ID" value="<?= $id ?>" disabled>
            <input type="number" class="form_input" name="numero" placeholder="Número" value="<?= $numero ?>" required>
            <input type="text" class="form_input" name="tipo" placeholder="Tipo" value="<?= $tipo ?>" required>
            <input type="number" class="form_input" name="piso" placeholder="Piso" value="<?= $piso ?>" required>
            <select name="ocupada" class="form_input" required>
                <option value="Disponible" <?= ($ocupada == 0) ? 'selected' : '' ?>>Disponible</option>
                <option value="No disponible" <?= ($ocupada == 1) ? 'selected' : '' ?>>No disponible</option>
            </select>
            <input type="submit" class="form_submit" value="Guardar cambios">
            <a href="registro_habitaciones.php" class="form_link">Volver</a>
        </form>
    </div>
</body>

</html>
