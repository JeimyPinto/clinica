<?php
include("../connection/connection.php");

$con = connection();

$sql = "SELECT * FROM medicos";
$query = mysqli_query($con, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['especialidad']) && isset($_POST['telefono']) && isset($_POST['correo'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $especialidad = $_POST['especialidad'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        $sql_insert = "INSERT INTO medicos (id, nombre, especialidad, telefono, correo) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($con, $sql_insert);

        if ($stmt_insert) {
            mysqli_stmt_bind_param($stmt_insert, "issss", $id, $nombre, $especialidad, $telefono, $correo);
            $result_insert = mysqli_stmt_execute($stmt_insert);

            if ($result_insert) {
                echo "Los datos se han insertado correctamente en la base de datos.";
                header("Location: registro_medicos.php");
                exit();
            } else {
                echo "Error al insertar los datos en la base de datos: " . mysqli_error($con);
            }
            mysqli_stmt_close($stmt_insert);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>

<body>
    <div class="form_group">
        <form action="" method="POST">
            <h1 class="form_title">Crear Médico</h1>
            <input class="form_input" type="number" name="id" placeholder="Id del médico" required>
            <input class="form_input" type="text" name="nombre" placeholder="Nombre" required>
            <input class="form_input" type="text" name="especialidad" placeholder="Especialidad" required>
            <input class="form_input" type="number" name="telefono" placeholder="Teléfono" required>
            <input class="form_input" type="email" name="correo" placeholder="Correo" required>
            <input class="form_submit" type="submit" value="Registrar">
        </form>
    </div>

    <div class="form_group">
        <h2>Médicos Registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)):
                    ?>
                    <tr>
                        <th>
                            <?= $row['id'] ?>
                        </th>
                        <th>
                            <?= $row['nombre'] ?>
                        </th>
                        <th>
                            <?= $row['especialidad'] ?>
                        </th>
                        <th>
                            <?= $row['telefono'] ?>
                        </th>
                        <th>
                            <?= $row['correo'] ?>
                        </th>
                        <th><a href="editar_medicos.php?id=<?= $row['id'] ?>" class="form_link">Editar</a></th>
                        <th><a href="eliminar_medicos.php?id=<?= $row['id'] ?>" class="form_link"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este médico?')">Eliminar</a>
                        </th>
                    </tr>
                    <?php
                endwhile;
                ?>
            </tbody>
        </table>
        <br><br><br>
        <a href="../menu.php" class="form_link">Volver al Menu</a>
    </div>
</body>

</html>