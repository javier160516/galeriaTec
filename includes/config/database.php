<?php 

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'root', 'galeria');

    if(!$db){
        echo 'Hubo un error al conectar la base de datos';
    }

    return $db;
}