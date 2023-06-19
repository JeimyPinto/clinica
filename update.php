<?php
include("../connection/connection.php");
$con = connection();

$id=$_GET['idusuario'];    
$sql = "SELECT * FROM usuario WHERE id='$id'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);


$sql_neighborhoods = "SELECT * FROM usuario";
$query_neighborhoods = mysqli_query($con, $sql_neighborhoods);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuarios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="users-form">
        <form action="edit_user.php" method="POST">
            <h1>Editar Usuario</h1>
            <input type="text" name="id" placeholder="Nombre" value="<?= $row['idusuario'] ?>">
            <input type="password" name="contrasena" placeholder="Contraseña" value="<?= $row['contrasena'] ?>">
            <input class="myInput"  type="number" name="tipo_usuario" placeholder="Tipo de usuario" value="<?= $row['tipo_usuario'] ?>">
            <input type="submit" value="Guardar">
            <a href="../menu.php" class="users-table--edit">Volver</a>
        </form>
    </div>
    
</body>
</html> 