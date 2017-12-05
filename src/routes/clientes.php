<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener todos los clientes
$app->get('/categories', function(Request $request, Response $response){
    $consulta = "SELECT * FROM at_categoria_music";
    try{
        // Instanciar la base de datos
        $db = new db();
        // Conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $albums = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withJson($albums);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/categories/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $consulta = "SELECT * FROM at_categoria_music WHERE idm='$id'";
    try{
        // Instanciar la base de datos
        $db = new db();
        // Conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $album = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withJson($album);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/categories/{id}/albums', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $consulta = "SELECT * FROM at_album WHERE categorias='$id'";
    try{
        // Instanciar la base de datos
        $db = new db();
        // Conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $album = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withJson($album);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});