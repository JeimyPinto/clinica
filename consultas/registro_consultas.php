<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $con = connection();

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
    <title>Usuarios</title>
    <link rel="stylesheet" href="../CSS/styleWelcome.css">
</head>

<body>
    <div class="users-form">
        <form action="" method="POST">
            <h1>Crear Consultas</h1>
            <input class="myInput" type="number" name="id" placeholder="Id de la consulta" required>
            <input type="password" name="contrasena" placeholder="Contrasena" required>
            <input class="myInput" type="text" name="tipo_Usuario" placeholder="tipo de usuario" required>
            <input type="submit" value="Registrar">
        </form>
    </div>

    <div>
        <h2>Consultas Registradas</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Id del usuario</th>
                    <th>Contraseña</th>
                    <th>Tipo de usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)):
                    ?>
                    <tr>
                        <th>
                            <?= $row['id_Usuario'] ?>
                        </th>
                        <th>
                            <?= $row['contrasena'] ?>
                        </th>
                        <th>
                            <?= $row['tipo_Usuario'] ?>
                        </th>
                        <th><a href="../usuarios/editar_usuarios.php?id_Usuario=<?= $row['id_Usuario'] ?>"
                                class="users-table--edit">Editar</a></th>
                        <th><a href="../usuarios/eliminar_usuarios.php?id_Usuario=<?= $row['id_Usuario'] ?>"
                                class="users-table--delete"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar</a>
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