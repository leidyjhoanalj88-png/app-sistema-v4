<?php
// Desactivar errores para que no ensucien la respuesta del JS
error_reporting(0);
require_once('../lib/funciones.php');

$ip = $_SERVER['REMOTE_ADDR'];

if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    if ($registro && isset($registro['estado'])) {
        echo trim($registro['estado']);
    } else {
        // Si no encuentra el registro, mandamos 1 para que no se trabe
        echo "1"; 
    }
} else {
    // Si la función falla, mandamos un estado por defecto
    echo "1";
}
?>
