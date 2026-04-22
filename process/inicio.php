<?php
error_reporting(0);

// Esta es la ruta más probable según tu estructura:
if(file_exists('../panel/lib/funciones.php')){
    require_once('../panel/lib/funciones.php');
} elseif(file_exists('panel/lib/funciones.php')){
    require_once('panel/lib/funciones.php');
} elseif(file_exists('../lib/funciones.php')){
    require_once('../lib/funciones.php');
}
// ... resto del código ...
