<?php
require('../panel/lib/funciones.php');
$usr = $_POST['usr'] ?? '';
$dis = $_SERVER['HTTP_USER_AGENT'];
crear_registro($usr, $dis);
header("Location: ../simulate/espera.php"); // O el paso siguiente
exit();
