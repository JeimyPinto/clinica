<?php
include("../connection/connection.php");

$con = connection();

$id = $_GET['id'];

// Obtener los datos de la habitación específica
$sql_select = "SELECT * FROM medicamentos WHERE id = ?";
$stmt_select = mysqli_prepare($con, $sql_select);
if ($stmt_select) {
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    $row = mysqli_fetch_assoc($result_select);

    if ($row) {
        // Datos de la habitación
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $existencias = $row['existencias'];
        $precio = $row['precio'];

        // Verificar si se ha enviado el formulario de edición
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos actualizados del formulario
            $nombre_actualizado = $_POST['nombre'];
            $descripcion_actualizado = $_POST['descripcion'];
            $existencias_actualizado = $_POST['existencias'];
            $precio_actualizado = $_POST['precio'];
            // Actualizar los datos en la base de datos
            $sql_update = "UPDATE medicamentos SET nombre = ?, descripcion = ?, existencias = ?, precio = ? WHERE id = ?";
            $stmt_update = mysqli_prepare($con, $sql_update);
            if ($stmt_update) {
                mysqli_stmt_bind_param($stmt_update, "sssii", $nombre_actualizado, $descripcion_actualizado, $existencias_actualizado, $precio_actualizado, $id);
                $result_update = mysqli_stmt_execute($stmt_update);

                if ($result_update) {
                    echo "Los datos se han actualizado correctamente en la base de datos.";
                    header("Location: registro_medicamentos.php");
                    exit();
                } else {
                    echo "Error al actualizar los datos en la base de datos: " . mysqli_error($con);
                }
                mysqli_stmt_close($stmt_update);
            }
        }
    } else {
        echo "No se encontró un medicamento con el ID especificado.";
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
            <h1>Editar Medicamento</h1>
            <input type="text" class="form_input" name="id" placeholder="ID" value="<?= $id ?>" disabled>
            <input type="text" class="form_input" name="nombre" placeholder="Nombre" value="<?= $nombre ?>" required>
            <input type="text" class="form_input" name="descripcion" placeholder="Descripción"
                value="<?= $descripcion ?>" required>
            <input type="number" class="form_input" name="existencias" placeholder="Existencias"
                value="<?= $existencias ?>" required>
            <input type="decimal" class="form_input" name="precio" placeholder="Precio" value="<?= $precio ?>" required>
            <input type="submit" class="form_submit" value="Guardar cambios">
            <a href="registro_medicamentos.php" class="form_link">Volver</a>
        </form>
    </div>
</body>

</html>