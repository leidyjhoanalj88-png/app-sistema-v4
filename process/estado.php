<?php
error_reporting(0);
// Ruta corregida para Railway
if(file_exists('../panel/lib/funciones.php')){
    require_once('../panel/lib/funciones.php');
} else {
    require_once('../lib/funciones.php');
}

$ip = $_SERVER['REMOTE_ADDR'];
if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    echo ($registro) ? trim($registro['estado']) : "1";
} else {
    echo "1";
}
?>
