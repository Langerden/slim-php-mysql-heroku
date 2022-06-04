<?php
require_once './models/Pedido.php';
require_once './interfaces/IApiUsable.php';

class PedidoController extends Pedido implements IApiUsable
{
    
    public function CargarUno($request, $response, $args)
    {

        $parametros = $request->getParsedBody();
        
        $table_id = $parametros['table_id'];
        $client_id = $parametros['client_id'];
        $product_id = $parametros['product_id'];
        $sector = $parametros['sector'];
        $waitingTime = $parametros['waitingTime'];
        $order_status = $parametros['order_status'];

      if (!isset($parametros) ||
                      !isset($table_id) ||
                      !isset($client_id) ||
                      !isset($product_id) ||
                      !isset($sector)||
                      !isset($waitingTime)||
                      !isset($order_status)) {
        $payload = json_encode(array("error" => "Faltan ingresar datos."));
        $response = $response->withStatus(400);
      } else {

        $usuario = Usuario::GetUserById($client_id);
        $mesa = Mesa::GetTableById($table_id);

        if($usuario != null && $mesa != null){

            $pedido = new Pedido();
            $pedido->table_id = $table_id;
            $pedido->client_id = $client_id;
            $pedido->product_id = $product_id;
            $pedido->sector = $sector;
            $pedido->waitingTime = $waitingTime;
            $pedido->order_status = $order_status;
            $pedido->CreateOrder();

              $payload = json_encode(array("mensaje" => "Pedido " .$pedido->id. " creado con exito."));
              $response = $response->withStatus(201);
        }else{
            $payload = json_encode(array("mensaje" => "Id Usuario o Id Mesa, INEXISTENTES"));
        }
      }
      $response->getBody()->write($payload);
      return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $pedido = Pedido::GetOrderById($id);
        $payload = json_encode($pedido);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function TraerTodos($request, $response, $args)
    {      
        $lista = Pedido::GetAll();
        $payload = json_encode(array("orders" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['id'];
        $table_id = $parametros['table_id'];
        $client_id = $parametros['client_id'];
        $product_id = $parametros['product_id'];
        $sector = $parametros['sector'];
        $waitingTime = $parametros['waitingTime'];
        $order_status = $parametros['order_status'];

        Pedido::UpdateOrder($id,$table_id,$client_id,$product_id,$sector,$waitingTime,$order_status);

        $payload = json_encode(array("mensaje" => "Pedido " .$id. " modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        Pedido::DataBaseDeleteOrderById($id);

        $payload = json_encode(array("mensaje" => "Pedido " .$id. " borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }
  }
?>