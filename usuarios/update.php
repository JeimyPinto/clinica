<?php
include("../connection/connection.php");
$con = connection();
$idusuario = isset($_GET['idusuario']) ? $_GET['idusuario'] : null;

$sql = "SELECT * FROM usuario WHERE idusuario='$idusuario'";
$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) > 0){
    $row = mysqli_fetch_array($query);
}else{
    $row = array(); 
    echo "sapo";
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
        <form action="edit_user.php" method="POST">
            <h1>Editar Usuario</h1>
            <input type="text" name="idusuario" placeholder="Nombre" value="<?= isset($row['idusuario']) ? $row['idusuario'] : '' ?>">
            <input type="text" name="contrasena" placeholder="Contraseña" value="<?= isset($row['contrasena']) ? $row['contrasena'] : '' ?>">
            <input class="myInput" type="number" name="tipo_usuario" placeholder="Tipo de usuario" value="<?= isset($row['tipo_usuario']) ? $row['tipo_usuario'] : '' ?>">
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
