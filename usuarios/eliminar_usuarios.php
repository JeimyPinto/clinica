<?php
include("../connection/connection.php");

$con = connection();

$id_Usuario = $_GET['id_Usuario'];

$sql = "DELETE FROM usuario WHERE id_Usuario='$id_Usuario'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: ../usuarios/registro_usuarios.php");
    
} else {
echo "No se pudo borrar el usuario.";
}

?>