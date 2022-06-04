<?php
require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

class UsuarioController extends Usuario implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $name = $parametros['username'];
        $lastname = $parametros['lastname'];
        $password = $parametros['userPassword'];
        $user_type = $parametros['user_type'];
        $email = $parametros['email'];

        // Creamos el usuario
        $user = new Usuario();
        $user->username = $name;
        $user->lastname = $lastname;
        $user->userPassword = $password;
        $user->user_type = $user_type;
        $user->email = $email;
        $user->CreateUser();

        $payload = json_encode(array("mensaje" => "Usuario creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(201);
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos usuario por id
        $id = $args['id'];
        $usuario = Usuario::GetUserById($id);
        $payload = json_encode($usuario);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Usuario::GetAll();
        $payload = json_encode(array("users" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $id = $args['id'];
        
        $name = $parametros['username'];
        $lastname = $parametros['lastname'];
        $password = $parametros['userPassword'];
        $user_type = $parametros['user_type'];
        $active = $parametros['active'];
        $email = $parametros['email'];
        
        Usuario::UpdateUser($id, $name, $lastname, $password, $user_type, $active, $email);

        $payload = json_encode(array("mensaje" => "Usuario ".$id." modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];

        Usuario::DataBaseDeleteUserById($id);

        $payload = json_encode(array("mensaje" => "Usuario ".$id ." borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }
}
