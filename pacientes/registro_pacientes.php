<?php
include("../connection/connection.php");

$con = connection();

$sql = "SELECT * FROM pacientes";
$query = mysqli_query($con, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['fechaNacimiento']) && isset($_POST['genero']) && isset($_POST['direccion']) && isset($_POST['telefono'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        $sql_insert = "INSERT INTO pacientes (id, nombre, fechaNacimiento, genero, direccion,telefono) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($con, $sql_insert);

        if ($stmt_insert) {
            mysqli_stmt_bind_param($stmt_insert, "isdsss", $id, $nombre, $fechaNacimiento, $genero, $direccion, $telefono);
            $result_insert = mysqli_stmt_execute($stmt_insert);

            if ($result_insert) {
                echo "Los datos se han insertado correctamente en la base de datos.";
                header("Location: registro_pacientes.php");
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
    <title>Pacientes</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>

<body>
    <div class="form_group">
        <form action="" method="POST">
            <h1 class="form_title">Crear Paciente</h1>
            <input class="form_input" type="number" name="id" placeholder="Id del médico" required>
            <input class="form_input" type="text" name="nombre" placeholder="Nombre" required>
            <input class="form_input" type="date" name="fechaNacimiento" placeholder="Fecha de Nacimiento" required>
            <input class="form_input" type="text" name="genero" placeholder="Género" required>
            <input class="form_input" type="text" name="direccion" placeholder="Dirección" required>
            <input class="form_input" type="text" name="telefono" placeholder="Teléfono" required>
            <input class="form_submit" type="submit" value="Registrar">
        </form>
    </div>

    <div class="form_group">
        <h2>Pacientes Registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Género</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
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
                            <?= $row['fechaNacimiento'] ?>
                        </th>
                        <th>
                            <?= $row['genero'] ?>
                        </th>
                        <th>
                            <?= $row['direccion'] ?>
                        </th>
                        <th>
                            <?= $row['telefono'] ?>
                        </th>
                        <th><a href="editar_pacientes.php?id=<?= $row['id'] ?>" class="form_link">Editar</a></th>
                        <th><a href="eliminar_pacientes.php?id=<?= $row['id'] ?>" class="form_link"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este paciente?')">Eliminar</a>
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