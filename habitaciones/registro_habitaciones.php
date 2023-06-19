<?php
include("../connection/connection.php");

$con = connection();

$sql = "SELECT * FROM habitaciones";
$query = mysqli_query($con, $sql);
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['id']) && isset($_POST['numero']) && isset($_POST['tipo']) && isset($_POST['piso']) && isset($_POST['ocupada'])) {

        $id = $_POST['id'];
        $numero = $_POST['numero'];
        $tipo = $_POST['tipo'];
        $piso = $_POST['piso'];
        $ocupada = $_POST['ocupada'];


        $sql_insert = "INSERT INTO habitaciones VALUES($id, $numero, '$tipo',$piso,$ocupada)";
        $stmt_insert = mysqli_prepare($con, $sql_insert);

        if ($stmt_insert) {
            mysqli_stmt_bind_param($stmt_insert, "iisii", $id, $numero, $tipo, $piso, $ocupada);
            $result_insert = mysqli_stmt_execute($stmt_insert);

            if ($result_insert) {
                echo "Los datos se han insertado correctamente en la base de datos.";
                header("Location: registro_habitaciones.php");
                exit();
            } else {
                echo "Error al insertar los datos en la base de datos: " . mysqli_error($con);
            }
            mysqli_stmt_close($stmt_insert);
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
    <title>Habitaciones</title>
    <link rel="stylesheet" href="../CSS/styleWelcome.css">
</head>

<body>
    <div class="users-form">
        <form action="" method="POST">
            <h1>Crear Habitación</h1>
            <input class="myInput" type="number" name="id" placeholder="Id de la habitación" required>
            <input type="number" name="numero" placeholder="Número" required>
            <input type="text" name="tipo" placeholder="Tipo" required>
            <input type="number" name="piso" placeholder="Piso" required>
            <select name="ocupada" id="ocupada" required>
                <option value="0">Disponible</option>
                <option value="1">No disponible</option>
            </select>
            <input type="submit" value="Registrar">
        </form>
    </div>

    <div>
        <h2>Habitaciones Registradas</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Piso</th>
                    <th>Disponibilidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)) :
                ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['numero'] ?></th>
                        <th><?= $row['tipo'] ?></th>
                        <th><?= $row['piso'] ?></th>
                        <th><?= $row['ocupada'] ?></th>
                        <th><a href="../usuarios/editar_usuarios.php?id_Usuario=<?= $row['id_Usuario'] ?>" class="users-table--edit">Editar</a></th>
                        <th><a href="../usuarios/eliminar_usuarios.php?id_Usuario=<?= $row['id_Usuario'] ?>" class="users-table--delete" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar</a></th>
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