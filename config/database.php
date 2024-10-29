<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://ascarzaandrew:W3WMSwYUXTSeJllw@cluster0.pc5tu.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
    $database = $mongoClient->selectDataBase('almacen');
    $tasksCollection = $database->tareas;
?>