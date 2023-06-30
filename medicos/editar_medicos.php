<?php
include("../connection/connection.php");

$con = connection();

$id = $_GET['id'];

// Obtener los datos de la habitación específica
$sql_select = "SELECT * FROM medicos WHERE id = ?";
$stmt_select = mysqli_prepare($con, $sql_select);
if ($stmt_select) {
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    $row = mysqli_fetch_assoc($result_select);

    if ($row) {
        // Datos de la habitación
        $nombre = $row['nombre'];
        $especialidad = $row['especialidad'];
        $telefono = $row['telefono'];
        $correo = $row['correo'];

        // Verificar si se ha enviado el formulario de edición
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos actualizados del formulario
            // Obtener los datos actualizados del formulario
            $nombre_actualizado = $_POST['nombre'];
            $especialidad_actualizado = $_POST['especialidad'];
            $telefono_actualizado = $_POST['telefono'];
            $correo_actualizado = $_POST['correo'];



            // Actualizar los datos en la base de datos
            $sql_update = "UPDATE medicos SET nombre = ?, especialidad = ?, telefono = ?, correo = ? WHERE id = ?";
            $stmt_update = mysqli_prepare($con, $sql_update);
            if ($stmt_update) {
                mysqli_stmt_bind_param($stmt_update, "ssssi", $nombre_actualizado, $especialidad_actualizado, $telefono_actualizado, $correo_actualizado, $id);
                $result_update = mysqli_stmt_execute($stmt_update);

                if ($result_update) {
                    echo "Los datos se han actualizado correctamente en la base de datos.";
                    header("Location: registro_medicos.php");
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
    <title>Editar Médico</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_container form_group">
        <form action="" method="POST" class="form">
            <h1>Editar Médico</h1>
            <input type="number" class="form_input" name="id" placeholder="ID" value="<?= $id ?>" disabled>
            <input type="text" class="form_input" name="nombre" placeholder="Nombre" value="<?= $nombre ?>" required>
            <input type="text" class="form_input" name="especialidad" placeholder="Especialidad"
                value="<?= $especialidad ?>" required>
            <input type="text" class="form_input" name="telefono" placeholder="telefono" value="<?= $telefono ?>"
                required>
            <input type="email" class="form_input" name="correo" placeholder="correo" value="<?= $correo ?>" required>

            <input type="submit" class="form_submit" value="Guardar cambios">
            <a href="registro_medicos.php" class="form_link">Volver</a>
        </form>
    </div>
</body>

</html>