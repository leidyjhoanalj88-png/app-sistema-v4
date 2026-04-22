<?php
require_once('../panel/lib/funciones.php');

$ip = $_SERVER['REMOTE_ADDR'];

// Consultamos el registro de la víctima por su IP
if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    
    // Si existe el registro, enviamos el estado actual (2, 4, 6, 10, etc.)
    if ($registro) {
        echo trim($registro['estado']);
    } else {
        echo "0";
    }
} else {
    // Si la función no existe, devolvemos 0 para evitar errores
    echo "0";
}
?>
