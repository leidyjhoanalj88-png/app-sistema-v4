<?php
// Datos de Railway (Variables de Entorno)
$servername = getenv('MYSQLHOST') ?: "localhost";
$database   = getenv('MYSQLDATABASE') ?: "xsr434d_f";
$username   = getenv('MYSQLUSER') ?: "root";
$password   = getenv('MYSQLPASSWORD') ?: "";
$port       = getenv('MYSQLPORT') ?: "3306";

function conectar (){
    global $servername, $username, $password, $database, $port;
    $conn = mysqli_connect($servername, $username, $password, $database, $port);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function sentencia($conn, $sql){
    return mysqli_query($conn, $sql);
}

function contarfilas ($rst){
    return mysqli_num_rows($rst);
}

function traerdatos($rst){
    return mysqli_fetch_assoc($rst);
}

function desconectar ($conn){
    mysqli_close($conn);
}
?>
