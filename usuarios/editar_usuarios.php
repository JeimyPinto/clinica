<?php
include("../connection/connection.php");

$con = connection();
if (isset($_GET['id_Usuario'])) {
    $id_Usuario = $_GET['id_Usuario'];
}
$sql = "SELECT * FROM usuario WHERE id_Usuario='$id_Usuario'";
$query = mysqli_query($con, $sql);
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos de la primera fila encontrada
    $row = $result->fetch_assoc();
    // Acceder a los otros datos encontrados
    $contrasena = $row['contrasena'];
    $tipo_Usuario = $row['tipo_Usuario'];
}
if (isset($_POST['Actualizar'])) {
    $contrasena = $_POST['contrasena'];
    $tipo_Usuario = $_POST['tipo_Usuario'];

    $sql = "UPDATE usuario SET contrasena='$contrasena', tipo_Usuario='$tipo_Usuario' WHERE id_Usuario=$id_Usuario ";
    $query = mysqli_query($con, $sql);

    if ($con->query($sql)) {
        Header("Location: ../usuarios/registro_usuarios.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuarios</title>
    <link rel="stylesheet" href="../CSS/styleWelcome.css">
</head>

<body>
    <div class="users-form">
        <form action="" method="POST">
            <h1>Editar Usuario</h1>
            <input type="text" name="id_Usuario" placeholder="Nombre" value="<?= $id_Usuario ?>" disabled>
            <input type="text" name="contrasena" placeholder="Contraseña" value="<?= $contrasena ?>">
            <input class="myInput" type="text" name="tipo_Usuario" placeholder="Tipo de usuario" value="<?= $tipo_Usuario ?>">
            <input type="submit" value="Actualizar" name="Actualizar">
            <a href="registro_usuarios.php" class="users-table--edit">Volver</a>
        </form>
    </div>
</body>

</html>