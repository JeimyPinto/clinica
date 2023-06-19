<?php
include("connection.php");

$con = connection();

$id = $_GET['id'];

$sql = "DELETE FROM person WHERE id='$id'";

$query = mysqli_query($con, $sql);

if($query){
    Header("Location: welcome.php");
} else {
echo "No se pudo borrar el usuario.";
}

?>