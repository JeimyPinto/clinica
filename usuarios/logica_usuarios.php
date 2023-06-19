<?php
include("../connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $con = connection();

    if (isset($_POST['idusuario']) && isset($_POST['contrasena']) && isset($_POST['tipo_usuario'])){
        
        $idusuario = $_POST['idusuario'];
        $contrasena = $_POST['contrasena'];
        $tipo_usuario = $_POST['tipo_usuario'];
        
        $sql = "INSERT INTO usuario VALUES('$idusuario', '$contrasena', '$tipo_usuario')";
        $query = mysqli_query($con, $sql);

        if($query){
            Header("Location: registro_usuarios.php");
        }
    } else {
        echo "No se enviaron todos los datos necesarios.";
    }
}
?>
