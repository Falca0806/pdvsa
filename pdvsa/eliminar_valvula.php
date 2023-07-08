<?php
include("conexion.php");
$id = $_GET['id'];
$query = "SELECT fecha_hora,medida,pozo_id from registro where id_registro=$id";
$resultado = mysqli_query($conn,$query);
$rows = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Valvula  <?php echo $rows['nombre_pozo'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container"> <br>

    <form action="" method="POST" class="text-center">
    <h2 class="" > ¿Deseas eliminar los datos registrados en la valvula? </h2><br><br>
    <label class="form-label"> ID Pozo: <?php echo $rows['pozo_id'] ?> </label><br>
    <label class="form-label"> Fecha y hora de registro: <?php echo $rows['fecha_hora'] ?> </label> <br>
    <label class="form-label"> Valor PSI: <?php echo $rows['medida'] ?> </label> <br> <br>

    <button type="submit" class="btn btn-danger" name="btnBorrar">Borrar Registro</button>
    <button type="submit" class="btn btn-primary" name="btnVolver" >Volver</button>
    </form>
    </div>
</body>
</html>

<?php 
if(isset($_POST['btnBorrar'])) {
    $idPozo = $rows['pozo_id'];
    $queryBorrar = "DELETE from registro where id_registro=$id";
    $resultado = mysqli_query($conn,$queryBorrar);
    header("Location:index_valvulas.php?id=$idPozo");
}

if(isset($_POST['btnVolver'])) {
    $idPozo = $rows['pozo_id'];
    header("Location:index_valvulas.php?id=$idPozo");
}

?>
