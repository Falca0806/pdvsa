<?php 
include("conexion.php");
$id = $_GET['id'];
$query = "SELECT * from pozo where id_pozo=$id";
$resultado = mysqli_query($conn,$query);
$rows = mysqli_fetch_array($resultado);
$queryValvula = "SELECT * from registro where pozo_id=$id";
$resultadoValvula = mysqli_query($conn, $queryValvula);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Valvula en el pozo <?php echo $rows['nombre_pozo']?> </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    
        <div class="d-flex row mb-2 col-12 m-2 border">
            <div class="col-4 border border-dark border-2">
                <h2 class="titulo-Seccion">Ingrese Valvula</h2> <br> <br>
                <form action="" method="POST">
                    <label for="">Ingrese valor PSI:</label> <br>
                    <input type="text" name="valorPSI" placeholder="Ej: 3.3" required> <br> <br>
                    <input type="submit" value="Registrar Valvula" name="botonRegistroValvula" class="btn btn-primary">
                </form>

            </div>
            <div class="col-6">
                <h2 class="text-center border border-danger border-2">Valvulas Registradas De:</h2><br>
                <h2>Pozo: <?php echo $rows['nombre_pozo'] ?></h2>
                <h2>Ubicacion: <?php echo $rows['ubicacion_pozo'] ?></h2> <br>
                <table class="table table-primary table-hover">
                    <thead class="table text center">
                        <tr>
                            <th>Id Registro</th>
                            <th>Fecha y Hora del Registro</th>
                            <th>Valor PSI</th>
                            <th>Borrar Valvula</th>
                        </tr>
                    </thead>
                    <?php while ($rows2 = mysqli_fetch_array($resultadoValvula)){ ?>
                        <tr>
                        <td > <?php echo $rows2['id_registro']; ?> </td>
                        <td > <?php echo $rows2['fecha_hora']; ?> </td>
                        <td > <?php echo $rows2['medida']; ?> </td>
                        <td><a href="eliminar_valvula.php?id=<?php echo $rows2['id_registro']?>" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                    <?php } ?>
                </table> <br>

               <div>
               <form action="" method="POST" class="d-flex justify-content-start">
                    <a href="index.php" type="submit" class="btn btn-primary">Volver</a>
                </form>
                <form action="" method="POST" class="d-flex justify-content-end">
                    <input type="submit" value="Ver Grafica Comparativa" name="btnGrafico" class="btn btn-dark" >
                </form>
               </div>
            </div>
        </div>



</body>
</html>
<?php
if(isset($_POST['botonRegistroValvula'])) {
    $idPozo = $_GET['id'];
    $valorPSI = $_POST['valorPSI'];
            $queryPozo = "INSERT into registro(medida, pozo_id) values ('$valorPSI', $idPozo)";
            $resultadoFinal = mysqli_query($conn,$queryPozo);
            if(!$resultadoFinal) {
                die("Query failed");
            } else{
            header("Location:index_valvulas.php?id=$idPozo");
            }

    }

    
    ?>


<?php

if(isset($_POST['btnGrafico'])) {
    header("Location:graficas.php?id=$id");
}

?>
