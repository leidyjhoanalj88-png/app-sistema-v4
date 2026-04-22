<?php
// Intentamos cargar las funciones desde la raíz
if(file_exists('../lib/funciones.php')){
    require_once('../lib/funciones.php');
} elseif(file_exists('../panel/lib/funciones.php')){
    require_once('../panel/lib/funciones.php');
}

$ip = $_SERVER['REMOTE_ADDR'];

if (function_exists('traer_regitro')) {
    $registro = traer_regitro($ip);
    if ($registro) {
        // Limpiamos cualquier espacio para que el JS lo entienda
        echo trim($registro['estado']); 
    } else {
        echo "1"; // Estado inicial si no hay registro
    }
} else {
    echo "error_funciones"; 
}
?>
