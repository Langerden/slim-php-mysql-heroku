<?php
require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

class MesaController extends Mesa implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $client_id = $parametros['client_id'];
        $waiter_id = $parametros['waiter_id'];
        $capacity = $parametros['capacity'];
        $invoice = $parametros['invoice'];

        $mesa = new Mesa();
        $mesa->client_id = $client_id;
        $mesa->waiter_id = $waiter_id;
        $mesa->capacity = $capacity;
        $mesa->invoice = $invoice;
        $mesa->CreateTable();

        $payload = json_encode(array("mensaje" => "Mesa " .$mesa->id . " creada con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(201);
    }

    public function TraerUno($request, $response, $args)
    {

        $id = $args['id'];
        $mesa = Mesa::GetTableById($id);
        $payload = json_encode($mesa);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Mesa::GetAll();
        $payload = json_encode(array("tables" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['id'];
        $client_id = $parametros['client_id'];
        $waiter_id = $parametros['waiter_id'];
        $table_status = $parametros['table_status'];
        $capacity = $parametros['capacity'];
        $invoice = $parametros['invoice'];

        Mesa::UpdateTable($id,$client_id,$waiter_id,$table_status,$capacity,$invoice);

        $payload = json_encode(array("mensaje" =>  "Mesa ".$id." modificada con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        Mesa::DataBaseDeleteTableById($id);

        $payload = json_encode(array("mensaje" => "Mesa ".$id." borrada con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

}