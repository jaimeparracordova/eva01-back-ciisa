<?php
include_once '../version1.php';

//parametros
$existeId = false;
$valorId = 0;

if (count($_parametros)>0){
    foreach($_parametros as $p){
        if(strpos($p, 'id') !== false){
            $existeId = true;
            $valorId = explode('=', $p)[1];
        }
    }
}

if($_version == 'v1'){
    if ($_mantenedor == 'mantenedor'){
        switch ($_metodo) {
            case 'GET':
                if ($_header == $_token_get) {
                    $data = [
                        ["id" => 0, "nombre" => 'Producto 1', "activo" => true],
                        ["id" => 1, "nombre" => 'Producto 2', "activo" => false],
                        ["id" => 2, "nombre" => 'Producto 3', "activo" => true]
                    ];
                    http_response_code(200);
                    echo json_encode(['data' => $data]);
                } else {
                    http_response_code(401);
                    echo json_encode(['error' => 'no tiene autorizacion GET']);
                }
                break;
        
            case 'POST':
                if ($_header == $_token_post) {
                    $data = ["id" => 3, "nombre" => 'Producto 4', "activo" => true];
                    http_response_code(201);
                    echo json_encode(['message' => 'Producto creado', 'data' => $data]);
                } else {
                    http_response_code(401);
                    echo json_encode(['error' => 'no tiene autorizacion POST']);
                }
                break;
        
            case 'PUT':
                if ($_header == $_token_put) {
                    $data = ["id" => 1, "nombre" => 'Producto 2 actualizado', "activo" => true];
                    http_response_code(200);
                    echo json_encode(['message' => 'Producto actualizado', 'data' => $data]);
                } else {
                    http_response_code(401);
                    echo json_encode(['error' => 'no tiene autorizacion PUT']);
                }
                break;
        
            case 'PATCH':
                if ($_header == $_token_patch) {
                    $data = ["id" => 1, "activo" => true];
                    http_response_code(200);
                    echo json_encode(['message' => 'Producto activado', 'data' => $data]);
                } else {
                    http_response_code(401);
                    echo json_encode(['error' => 'no tiene autorizacion PATCH']);
                }
                break;
        
            case 'DELETE':
                if ($_header == $_token_delete) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Producto eliminado']);
                } else {
                    http_response_code(401);
                    echo json_encode(['error' => 'no tiene autorizacion DELETE']);
                }
                break;
        
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Método no permitido']);
                break;
        }
    }
}