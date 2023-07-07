<?php
include("conexion.php");
$id = $_GET['id'];
$query = "SELECT nombre_pozo, ubicacion_pozo from pozo where id_pozo=$id";
$resultado = mysqli_query($conn,$query);
$rows = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Pozo  <?php echo $rows['nombre_pozo'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container"> <br>

    <form action="" method="POST" class="text-center">
    <h2 class="" > ¿Deseas eliminar los datos del pozo? </h2><br><br>
    <label class="form-label"> Nombre del Pozo: <b><?php echo $rows['nombre_pozo'] ?></b> </label> <br>
    <label class="form-label"> Ubicacion del Pozo: <b><?php echo $rows['ubicacion_pozo'] ?></b> </label> <br> <br>
    <button type="submit" class="btn btn-danger" name="btnBorrar">Borrar Registro</button>
    <button type="submit" class="btn btn-primary" name="btnVolver" >Volver</button>
    </form>
    </div>
</body>
</html>

<?php 
if(isset($_POST['btnBorrar'])) {
    $queryBorrarRegistros = "DELETE from registro where pozo_id=$id";
    $resultadoRegistro = mysqli_query($conn,$queryBorrarRegistros);
    $queryBorrar = "DELETE from pozo where id_pozo=$id";
    $resultado = mysqli_query($conn,$queryBorrar);
    header("Location:index.php");
} 

if(isset($_POST['btnVolver'])) {
   header("Location:index.php");
}
?>