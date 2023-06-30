<?php
include("../connection/connection.php");

$con = connection();

$sql = "SELECT * FROM formulas";
$query = mysqli_query($con, $sql);

// Obtener listado de pacientes
$pacienteSql = "SELECT id, nombre FROM pacientes";
$pacienteQuery = mysqli_query($con, $pacienteSql);
$pacientes = array();
while ($row = mysqli_fetch_assoc($pacienteQuery)) {
    $pacientes[$row['id']] = $row['nombre'];
}

// Obtener listado de médicos
$medicoSql = "SELECT id, nombre FROM medicos";
$medicoQuery = mysqli_query($con, $medicoSql);
$medicos = array();
while ($row = mysqli_fetch_assoc($medicoQuery)) {
    $medicos[$row['id']] = $row['nombre'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['pacienteID']) && isset($_POST['medicoID']) && isset($_POST['fechaFormula'])) {
        $id = $_POST['id'];
        $pacienteID = $_POST['pacienteID'];
        $medicoID = $_POST['medicoID'];
        $fechaFormula = $_POST['fechaFormula'];

        $sql = "INSERT INTO formulas VALUES('$id', '$pacienteID', '$medicoID','$fechaFormula')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: registro_formulas.php");
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
    <title>Formulas</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_group">
        <form action="" method="POST" class="form">
            <h1 class="form_title">Crear Formula</h1>
            <input class="form_input" type="number" name="id" placeholder="Id de la fórmula" required>

            <select class="form_input" name="pacienteID" required>
                <option value="" disabled selected>Seleccionar paciente</option>
                <?php
                foreach ($pacientes as $id => $nombre) {
                    echo "<option value='$id'>$nombre</option>";
                }
                ?>
            </select>

            <select class="form_input" name="medicoID" required>
                <option value="" disabled selected>Seleccionar médico</option>
                <?php
                foreach ($medicos as $id => $nombre) {
                    echo "<option value='$id'>$nombre</option>";
                }
                ?>
            </select>

            <input class="form_input" type="date" name="fechaFormula" placeholder="Fecha de la fórmula" required>
            <input class="form_submit" type="submit" value="Registrar">
        </form>
    </div>

    <div>
        <h2 class="form_title">Formulas Registradas</h2>
        <table class="form_group">
            <thead>
                <tr>
                    <th>Id de la fórmula</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Fecha de la fórmula</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)):
                    $pacienteId = $row['pacienteId'];
                    $medicoId = $row['medicoId'];
                    ?>
                    <tr>
                        <td>
                            <?= $row['id'] ?>
                        </td>
                        <td>
                            <?= isset($pacientes[$pacienteId]) ? $pacientes[$pacienteId] : 'Desconocido' ?>
                        </td>
                        <td>
                            <?= isset($medicos[$medicoId]) ? $medicos[$medicoId] : 'Desconocido' ?>
                        </td>
                        <td>
                            <?= $row['fechaFormula'] ?>
                        </td>
                        <td><a href="editar_formulas.php?id=<?= $row['id'] ?>">Editar</a></td>
                        <td><a href="eliminar_formulas.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta fórmula?')">Eliminar</a>
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