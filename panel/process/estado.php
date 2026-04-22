<?php
// Corregimos la ruta para que encuentre las funciones correctamente
require_once('../lib/funciones.php');

$ip = $_SERVER['REMOTE_ADDR'];

// Consultamos el estado real en la base de datos
if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    
    if ($registro) {
        // Aquí obtenemos el número (2, 4, 6, 10, etc.)
        echo trim($registro['estado']);
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>
