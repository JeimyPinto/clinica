<?php
include("../connection/connection.php");

$con = connection();

$sql = "SELECT * FROM medicamentos";
$query = mysqli_query($con, $sql);
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['existencias']) && isset($_POST['precio'])) {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $existencias = $_POST['existencias'];
        $precio = $_POST['precio'];

        $sql = "INSERT INTO medicamentos (id, nombre, descripcion, existencias, precio) VALUES (?, ?, ?, ?, ?)";
        $query = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($query, 'isssd', $id, $nombre, $descripcion, $existencias, $precio);

        if (mysqli_stmt_execute($query)) {
            header("Location: registro_medicamentos.php");
        } else {
            echo "Error al insertar datos: " . mysqli_stmt_error($query);
        }

        mysqli_stmt_close($query);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_group">
        <form action="" method="POST" class="form">
            <h1 class="form_title">Crear Medicamento</h1>
            <input class="form_input" type="number" name="id" placeholder="Id del medicamento" required>
            <input class="form_input" type="text" name="nombre" placeholder="Nombre" required>
            <input class="form_input" type="text" name="descripcion" placeholder="Descripción" required>
            <input class="form_input" type="number" name="existencias" placeholder="Existencias" required>
            <input class="form_input" type="decimal" name="precio" placeholder="Precio" required>
            <input class="form_submit" type="submit" value="Registrar">
        </form>
    </div>


    <div>
        <h2 class="form_title">Medicamentos Registrados</h2>
        <table class="form_group">
            <thead>
                <tr>
                    <th>Id del medicamento</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Existencias</th>
                    <th>Precio</th>
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
                            <?= $row['descripcion'] ?>
                        </th>
                        <th>
                            <?= $row['existencias'] ?>
                        </th>
                        <th>
                            <?= $row['precio'] ?>
                        </th>
                        <th><a href="editar_medicamentos.php?id=<?= $row['id'] ?>">Editar</a></th>
                        <th><a href="eliminar_medicamentos.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este medicamento?')">Eliminar</a>
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