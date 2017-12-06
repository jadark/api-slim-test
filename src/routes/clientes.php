<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//get All Categories
$app->get('/categories', function(Request $request, Response $response){
    try{
        // Instanciar la base de datos
        $db = new db();
        // Conexión
        $db = $db->conectar();
        $queryStage = $db->query("CALL getCategories()");
        $albums = $queryStage->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withJson($albums);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/categories/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    try{
        // Instanciar la base de datos
        $db = new db();
        // Conexión
        $db = $db->conectar();
        $stageCategory = $db->query("CALL getCategory('$id')");
        $category = $stageCategory->fetchAll(PDO::FETCH_OBJ);
        if (!empty($category)) {
            $stageCategory->nextRowset();
            // get All Albums
            $stageAlbumsbyID = $db->query("CALL getAlbumsbyCategory('$id')");
            $allAlbums = $stageAlbumsbyID->fetchAll(PDO::FETCH_OBJ);
            if ($allAlbums) {
                $category[0]->albums = $allAlbums;
            }
            $db = null;
            return $response->withJson($category);
        }else{
            $response->getBody()->write("La categoria $id no existe actualmente."); 
            return $response->withStatus(404);
        }
       

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});