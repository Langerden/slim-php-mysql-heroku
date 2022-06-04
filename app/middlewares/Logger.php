<?php
use GuzzleHttp\Psr7\Response;

class Logger
{
    // public static function LogOperacion($request, $response, $next)
    // {
    //     $retorno = $next($request, $response);
    //     return $retorno;
    // }

    public static function VerificarCredenciales($request, $handler) {
        $method = $request->getMethod();
        // $response = $handler->handle($request);    
        $response = new Response();    

        if($method == 'GET') {            
            $response = $handler->handle($request);    
            $response->getBody()->write("El metodo de la solicitud es " . $method);            
        } else if ($method == 'POST') {
            // $response->getBody()->write("El metodo de la solicitud es " . $method);
            $data = $request->getParsedBody();
            $nombre = $data['nombre'];
            $perfil = $data['perfil'];

            if($perfil == 'admin') {
                $response = $handler->handle($request);    
                $response->getBody()->write("Bienvenido " . $nombre);
                $response->getBody()->write("El metodo de la solicitud es " . $method);            
                
            } else {
                $response->getBody()->write("No tenes permisos gil");
            }
        } 
        return $response;
    }

    public static function VerificarCredenciales3($request, $handler) {
        $method = $request->getMethod();        
        $response = new Response();                    

        if($method == 'GET') {                                    
          
            
        } else if ($method == 'POST') {
            $data = $request->getParsedBody();
            //var_dump($data);
            
            $usuario = json_decode($data['obj_json']);
            var_dump($usuario);

            // if($perfil == 'admin') {
            //     $response = $handler->handle($request);    
            //     $response->getBody()->write("Bienvenido " . $nombre);
            //     $response->getBody()->write("El metodo de la solicitud es " . $method);            
                
            // } else {
            //     $response->getBody()->write(json_encode(["ERROR" => "No tenes permisos"]));
            //     $response = $response->withStatus(403);
            // }
        } 
        return $response;
    }
}