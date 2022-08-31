<?php 

function conectarDB() {

    // $db = mysqli_connect('creativolab.com.mx', 'creativolabcom_pics', '532IR842B4', 'creativolabcom_pics');
    $db = mysqli_connect('localhost', 'root', 'root', 'galeria');

    if(!$db) {
        echo 'Hubo un error al conectar la base de datos';
    }
    return $db;
}