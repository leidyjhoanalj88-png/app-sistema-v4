<?php
require_once('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];

// Consultamos el estado real en la base de datos
if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    // Aquí obtenemos el número (2, 4, 6, 10, etc.)
    echo $registro['estado']; 
} else {
    echo "0";
}
?>
