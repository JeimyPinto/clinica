<?php
include("../connection/connection.php");

$con = connection();

$sql = "SELECT * FROM ingresos";
$query = mysqli_query($con, $sql);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

            } else {
                echo "Error al insertar los datos en la base de datos: " . mysqli_error($con);
            }
            mysqli_stmt_close($stmt_insert);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($con);
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
    <title>Ingresos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="form_container">
        <form action="" method="POST">
            <h1>Crear Ingreso</h1>
            <input type="number" name="id" placeholder="Id del Ingreso" required>
            <input type="number" name="pacienteID" placeholder="Id del paciente" required>
            <input type="text" name="fechaIngreso" placeholder="Fecha de ingreso" required>
            <input type="number" name="diagnostico" placeholder="Diagnostico" required>
            <input type="submit" value="Registrar">
        </form>
    </div>

    <div class="form_group">
        <h2>Ingresos Registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Id del paciente</th>
                    <th>Fecha de ingreso</th>
                    <th>Diagnostico</th>
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
                            <?= $row['pacienteID'] ?>
                        </th>
                        <th>
                            <?= $row['fechaIngreso'] ?>
                        </th>
                        <th>
                            <?= $row['diagnostico'] ?>
                        </th>
                        <th><a href="editar_ingresos.php?id=<?= $row['id'] ?>" class="form_link">Editar</a></th>
                        <th><a href="eliminar_ingresos.php?id=<?= $row['id'] ?>" class="form_link"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este ingreso?')">Eliminar</a>
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