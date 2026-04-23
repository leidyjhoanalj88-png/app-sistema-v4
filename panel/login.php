<?php 
session_start(); 
// Si ya inició sesión, lo mandamos al dashboard directamente
if (isset($_SESSION["usuario0608"])) {
    header("Location: admin/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="img/metronic.ico">
    <title>SCT - Acceso Administrativo</title>
    <link href="css/pluto-fonts.css" rel="stylesheet">
    <link href="css/styles-admin.css" rel="stylesheet">	
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>	
</head>
<body>
    <table border="0" cellpadding="0" cellspacing="0" class="inicio">
        <tr>
            <td class="portada">
                <div class="fondo-incial"></div>
            </td>
            <td class="login" align="center">
                <div style="max-width: 340px;">
                <span class="texto-institucional">SISTEMA DE CONTROL TRANSACCIONAL</span>
                <br><br><br><br>
                <p style="width:100%; text-align: left; font-size: 12px; font-weight: 400; mb-5">Bienvenido,</p>
                <p style="width:100%; text-align: left; font-size: 22px; font-weight: 300; mb-5">Ingrese aquí</p>
                
                <div class="input-container">
                    <input name="inp-usuario" id="inp-usuario" type="text" placeholder="Usuario" required />
                    <label for="inp-usuario">Usuario</label>
                </div>
                <br>
                <div class="input-container">
                    <input name="inp-pass" id="inp-pass" type="password" placeholder="Contraseña" required />
                    <label for="inp-pass">Contraseña</label>
                </div>
                <br>
                <button class="btn btn-azul" type="button" id="btn-ingresar">Ingresar</button>
                <br><br><br>
                <img src="img/logo.svg" width="200px">
                <span class="copyright">Desarrollado por <b>Metronic, Inc.</b> © 2026</span>
                </div>
            </td>
        </tr>	
    </table>

    <script type="text/javascript">
    $(document).ready(function(){
        $("#btn-ingresar").click(function(){
            var u = $("#inp-usuario").val();
            var p = $("#inp-pass").val();

            if (u == "" || p == "") {
                alert("Complete todos los campos");
                return;
            }

            // Llamada al validador (Este archivo debe existir en tu carpeta admin/)
            $.ajax({
                type: "POST",
                url: "admin/validador.php",
                data: { user: u, pass: p },
                success: function(res) {
                    if (res == "success") {
                        window.location.href = "admin/dashboard.php";
                    } else {
                        alert("Credenciales incorrectas");
                    }
                }
            });
        });
    });
    </script>
</body>
</html>
