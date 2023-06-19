<?php
include("connection/connection.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_Usuario']) && isset($_POST['contrasena'])) {

        $id_Usuario = $_POST['id_Usuario'];
        $contrasena = $_POST['contrasena'];

        $sql = "SELECT * FROM usuario WHERE id_Usuario = '$id_Usuario' AND contrasena = '$contrasena'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: menu.php");
            exit();
        } else {
            echo "El nombre de usuario o la contraseña es incorrecto.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Formulario</title>
    <link rel="stylesheet" href="css/estilos.css" />
</head>

<body>
    <form class="form" action="" method="post">
        <h2 class="form_title">Iniciar Sesión</h2>
        <p class="form_paragraph">
            ¿Aún no tienes una cuenta? <a href="#" class="form_link">Regístrate aquí</a>
        </p>
        <div class="form_container">
            <div class="form_group">
                <input type="text" name="id_Usuario" class="form_input" placeholder=" ">
                <label for="idusuario" class="form_label">Nombre de usuario: </label>
                <span class="form_line"></span>
            </div>
            <div class="form_group">
                <input type="password" name="contrasena" class="form_input" placeholder=" ">
                <label for="contrasena" class="form_label">Contraseña: </label>
                <span class="form_line"></span>
            </div>
            <input type="submit" class="form_submit" value="Entrar">
        </div>
    </form>
</body>

</html>