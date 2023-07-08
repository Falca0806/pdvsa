<?php
include("conexion.php");
$query = "SELECT * from pozo";
$queryResultado = mysqli_query($conn,$query);


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pozos Petroleros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="m-2">
    <h1 class="text-center">Pozos Petroleros</h1>

    <form class="d-flex row mb-2 col-12 m-2 border" method="POST">
        <div class="col-4 border border-dark border-2">
            <h2 class="text-center">Registro de Pozo</h2>
            <br>
            <label for="">Nombre</label>
            <textarea placeholder="Escribe aqui el nombre del pozo" class="form-control" name="nombre_pozo" reqfuired></textarea>
            <br>
            <label for="">Ubicacion</label>
            <textarea placeholder="Escribe aqui su ubicacion" class="form-control" name="ubicacion_pozo" style="height: 100px" reqfuired></textarea>
            <br>
                <input type="submit" class="btn btn-primary w-50" style="font-size: large;" name="botonRegistroPozo" value="Registrar">

            <?php
                    if(isset($_POST['botonRegistroPozo'])) {
                        $nombre_pozo = $_POST['nombre_pozo'];
                        $ubicacion = $_POST['ubicacion_pozo'];
                                $queryPozo = "INSERT into pozo(nombre_pozo, ubicacion_pozo) values ('$nombre_pozo', '$ubicacion')";
                                $resultadoFinal = mysqli_query($conn,$queryPozo);
                                if(!$resultadoFinal) {
                                    die("Query failed");
                                } else {
                            header("Location:index.php");
                        }

                    }
            ?>

        </div>

        <div class="col-8 border">
            <h2 class="text-center">Historial de Pozos</h2>
            <table class="table table-primary table-hover text-center">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nombre</th>
                        <th>Ubicacion</th>
                        <th>Eliminar</th>
                        <th>Valvulas</th>
                    </tr>
                </thead>
                <?php while ($rows = mysqli_fetch_array($queryResultado)){ ?>
            <tr>
                <td> <?php echo $rows['id_pozo']; ?></td>
                <td> <?php echo $rows['nombre_pozo']; ?> </td>
                <td> <?php echo $rows['ubicacion_pozo']; ?> </td>
                <td><a href="eliminar_pozo.php?id=<?php echo $rows['id_pozo']?>" class="btn btn-danger">Eliminar</a></td>

                <td><a href="index_valvulas.php?id=<?php echo $rows['id_pozo'] ?>" class="btn btn-primary">MEDIDAS</a> </td>
            </tr>
        <?php } ?>
            </table>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
