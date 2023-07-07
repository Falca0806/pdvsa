<?php

     include("conexion.php");

    $id = $_GET['id'];

    $peticion = "SELECT * FROM registro WHERE pozo_id = '$id'";
    $resultado = mysqli_query($conn,$peticion);
    $fecha = [];
    $valoresPSI = [];
    
    if(mysqli_num_rows($resultado) > 0) {
        while($array = mysqli_fetch_array($resultado)) {
           array_push($fecha, $array['fecha_hora']);
           array_push($valoresPSI, $array['medida']);
        }
    } else {

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container m-2">
        <h1 class="titulo-Seccion">Gráfico correspondiente al Pozo <?php echo $id ?> </h1>
    </div>
    <div class="container" style="text-align:center;width:40%;border:solid 1px black">
        <canvas id = "lineChart" height = "400" width = "400"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const CHART = document.getElementById("lineChart");
            console.log(CHART);
            let lineChart = new Chart(CHART, {
                type: "line",
                data: {
                    labels: [<?php echo '"'.implode('","',  $fecha ).'"' ?>],
                    datasets: [{
                        label: 'Valor PSI:',
                        data: [<?php echo '"'.implode('","',  $valoresPSI ).'"' ?>],
                        fill: false,
                        borderColor: 'rgb(120, 193, 243)',
                        tension: 0.1,
                        backgroundColor: 'rgb(120, 193, 243)',
                    }]
            }
        })
        </script>    
    </div> <br>
    <div class="container-Valvulas"> 
            <form action="" method="POST">
                <input type="submit" name="volverIndexValvulas" value="Volver a Valvulas" class="btn btn-primary">
            </form>
    </div>


</body>
</html>

<?php
if(isset($_POST['volverIndexValvulas'])) {
    header("Location:index_valvulas.php?id=$id");
}

?>