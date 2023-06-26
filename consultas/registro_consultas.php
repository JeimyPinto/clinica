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

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['idusuario']) && isset($_POST['contrasena']) && isset($_POST['tipo_usuario'])) {

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
            <h1>Crear Consultas</h1>
            <input class="myInput" type="number" name="id" placeholder="Id de la consulta" required>
            <input type="password" name="contrasena" placeholder="Contrasena" required>
            <input class="myInput" type="text" name="tipo_Usuario" placeholder="tipo de usuario" required>
            <input type="submit" value="Registrar">
        </form>
    </div>

    <div class="form_group">
        <h2>Consultas Registradas</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Id del paciente</th>
                    <th>Id del médico</th>
                    <th>Fecha de consulta</th>
                    <th>Duración (min)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)):
                    $pacienteId = $row['pacienteID'];
                    $nombrePaciente = isset($pacientes[$pacienteId]) ? $pacientes[$pacienteId] : 'Desconocido';
                    ?>
                    <tr>
                        <th>
                            <?= $row['id'] ?>
                        </th>
                        <td>
                            <?= $nombrePaciente ?>
                        </td>
                        <th>
                            <?= $row['medicosID'] ?>
                        </th>
                        <th>
                            <?= $row['fechaConsulta'] ?>
                        </th>
                        <th>
                            <?= $row['duracionMinutos'] ?>
                        </th>
                        <th><a href="editar_consultas.php?id=<?= $row['id'] ?>">Editar</a></th>
                        <th><a href="eliminar_consultas.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta consulta?')">Eliminar</a>
                        </th>
                    </tr>
                    <?php
                endwhile;
                ?>
            </tbody>
        </table>
        <br><br><br>
        <a href="../menu.php" class="users-table--edit">Volver al Menu</a>
    </div>
</body>

</html>