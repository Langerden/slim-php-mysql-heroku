<?php
require_once './models/Producto.php';
require_once './interfaces/IApiUsable.php';

class ProductoController extends Producto implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $productName = $parametros['productName'];
        $price = $parametros['price'];
        $product_type = $parametros['product_type'];

        $producto = new Producto();
        $producto->productName = $productName;
        $producto->price = $price;
        $producto->product_type = $product_type;
        $producto->CreateProduct();

        $payload = json_encode(array("mensaje" => "Producto ".$producto->id."creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(201);
    }

    public function TraerUno($request, $response, $args)
    {

        $id = $args['id'];
        $producto = Producto::GetProductById($id);
        $payload = json_encode($producto);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Producto::GetAll();
        $payload = json_encode(array("products" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['id'];
        $productName = $parametros['productName'];
        $price = $parametros['price'];
        $product_type = $parametros['product_type'];
        $active = $parametros['active'];

        Producto::UpdateProduct($id,$productName,$price,$product_type,$active);

        $payload = json_encode(array("mensaje" => "Producto ".$id." modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        Producto::DataBaseDeleteProductById($id);

        $payload = json_encode(array("mensaje" => "Producto ".$id." borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }

}