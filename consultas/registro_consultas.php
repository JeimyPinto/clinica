<?php
include("../connection/connection.php");
$con = connection();
$sql = "SELECT * FROM consultas";
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


    if (isset($_POST['id']) && isset($_POST['contrasena']) && isset($_POST['tipo_usuario'])) {

        $idusuario = $_POST['idusuario'];
        $contrasena = $_POST['contrasena'];
        $tipo_usuario = $_POST['tipo_usuario'];

        $sql = "INSERT INTO usuario VALUES('$idusuario', '$contrasena', '$tipo_usuario')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: welcome.php");
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
    <title>Consultas</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_container">
        <form action="" method="POST">
            <h1 class="form_title">Crear Consultas</h1>
            <input class="form_input" type="number" name="id" placeholder="Id de la consulta" required>
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
            <label for="fechaConsulta">Fecha de la consulta</label>
            <input class="form_input" type="date" name="fechaConsulta" placeholder="Fecha de la consulta" required>
            <input class="form_input" type="number" name="duracionMinutos" placeholder="Duración(minutos)" required>
            <input class="form_submit" type="submit" value="Registrar">
        </form>
    </div>

    <div class="form_group">
        <h2>Consultas Registradas</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Fecha de consulta</th>
                    <th>Duración (min)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)):
                    $pacienteId = $row['pacientesID'];
                    $medicoId = $row['medicosID'];
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
                            <?= $row['fechaConsulta'] ?>
                        </td>
                        <td>
                            <?= $row['duracionMinutos'] ?>
                        </td>
                        <td><a href="editar_consultas.php?id=<?= $row['id'] ?>">Editar</a></td>
                        <td><a href="eliminar_consultas.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta consulta?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php
                endwhile;
                ?>
            </tbody>
        </table>
        <a href="../menu.php" class="form_link">Volver al Menu</a>
    </div>
</body>

</html>