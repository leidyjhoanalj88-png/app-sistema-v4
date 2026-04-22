<?php
error_reporting(0);
require_once('../panel/lib/funciones.php');

$ip = $_SERVER['REMOTE_ADDR'];

if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    if ($registro) {
        // Si hay registro, enviamos el estado real de la base de datos
        echo trim($registro['estado']);
    } else {
        // Si es nuevo o no hay registro, devolvemos 4 para que cargue INFO
        echo "4";
    }
} else {
    // Si fallan las funciones, devolvemos 4 para no trabar el flujo
    echo "4";
}
?>
