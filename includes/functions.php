<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerProductos() {
        global $tasksCollection;
        return $tasksCollection->find();
    }

    function formatDate($date) {
        return $date->toDateTime()->format('Y-m-d');
    }
    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }
    function crearProducto($nombre, $descripcion, $precio, $stock) {
        global $tasksCollection;
        $resultado = $tasksCollection->insertOne([
            'nombre' => sanitizeInput($nombre),
            'descripcion' => sanitizeInput($descripcion),
            'precio' => sanitizeInput($precio),
            'stock' => sanitizeInput($stock),
            // 'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
        ]);
        return $resultado->getInsertedId();
    }
    function obtenerProductoPorId($id) {
        global $tasksCollection;
        return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarProducto($id, $nombre, $descripcion, $precio, $stock) {
        global $tasksCollection;
        $resultado = $tasksCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'descripcion' => sanitizeInput($descripcion),
                'precio' => sanitizeInput($precio),
                // 'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
                'stock' => sanitizeInput($stock)
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarProducto($id) {
        global $tasksCollection;
        $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    
?>