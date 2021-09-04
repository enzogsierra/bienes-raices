<?php
require __DIR__ . "/vendor/autoload.php";
use Model\ActiveRecord;


// Hacer debug a una variable
function debug($var, $ex = 1)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    if($ex) exit;
}

// Escapar/sanitizar HTML
function s($html)
{
    return htmlspecialchars($html);
}

// db
function conectarDB(): mysqli
{
    $db = new mysqli("localhost", "root", "root", "bienes_raices");
    if(!$db) 
    {
        echo "Error al conectar a la base de datos";
        exit;
    }
    return $db;
}
$db = conectarDB();
ActiveRecord::setDB($db);