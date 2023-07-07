<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'pdvsa_m'
);

if(isset($conn)) {
} else {
    echo "No se logro conectar";
}




?>