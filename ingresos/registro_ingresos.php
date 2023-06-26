<?php
include("../connection/connection.php");

$con = connection();

$sql = "SELECT * FROM ingresos";
$query = mysqli_query($con, $sql);

// Obtener listado de pacientes
$pacienteSql = "SELECT id, nombre FROM pacientes";
$pacienteQuery = mysqli_query($con, $pacienteSql);
$pacientes = array();
while ($row = mysqli_fetch_assoc($pacienteQuery)) {
    $pacientes[$row['id']] = $row['nombre'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['pacienteID']) && isset($_POST['fechaIngreso']) && isset($_POST['diagnostico'])) {
        $id = $_POST['id'];
        $pacienteID = $_POST['pacienteID'];
        $fechaIngreso = $_POST['fechaIngreso'];
        $diagnostico = $_POST['diagnostico'];

        $sql = "INSERT INTO ingresos VALUES('$id', '$pacienteID', '$fechaIngreso','$diagnostico')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: registro_ingresos.php");
        }
    } else {
        echo "No se enviaron todos los datos necesarios.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_group">
        <form action="" method="POST" class="form">
            <h1 class="form_title">Crear Ingreso</h1>
            <input class="form_input" type="number" name="id" placeholder="Id del ingreso" required>

            <select class="form_input" name="pacienteID" required>
                <option value="" disabled selected>Seleccionar paciente</option>
                <?php
                foreach ($pacientes as $id => $nombre) {
                    echo "<option value='$id'>$nombre</option>";
                }
                ?>
            </select>
            <label for="">Fecha de Ingreso</label>
            <input class="form_input" type="date" name="fechaIngreso" placeholder="Fecha de ingreso" required>
            <input class="form_input" type="text" name="diagnostico" placeholder="Diagnóstico" required>
            <input class="form_submit" type="submit" value="Registrar">
        </form>
    </div>

    <div>
        <h2 class="form_title">Ingresos Registrados</h2>
        <table class="form_group">
            <thead>
                <tr>
                    <th>Id del Ingreso</th>
                    <th>Paciente</th>
                    <th>Fecha de Ingreso</th>
                    <th>Diagnóstico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)):
                    $pacienteId = $row['pacienteID'];
                    ?>
                    <tr>
                        <td>
                            <?= $row['id'] ?>
                        </td>
                        <td>
                            <?= isset($pacientes[$pacienteId]) ? $pacientes[$pacienteId] : 'Desconocido' ?>
                        </td>
                        <td>
                            <?= $row['fechaIngreso'] ?>
                        </td>
                        <td>
                            <?= $row['diagnostico'] ?>
                        </td>
                        <td><a href="editar_ingresos.php?id=<?= $row['id'] ?>">Editar</a></td>
                        <td><a href="eliminar_ingresos.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este ingreso?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php
                endwhile;
                ?>
            </tbody>
        </table>
        <br><br><br>
        <a href="../menu.php" class="form_link">Volver al Menú</a>
    </div>
</body>

</html>