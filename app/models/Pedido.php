<?php

class Pedido
{
    public $id;
    public $table_id;
    public $client_id;
    public $product_id;
    public $sector;
    public $waitingTime;
    public $order_status;

    public function CreateOrder()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO orders (table_id,client_id,product_id,sector,waitingTime,order_status) 
                                                                     VALUES (:table_id,:client_id,:product_id,:sector,:waitingTime,:order_status)");
        
        $consulta->bindValue(':table_id', $this->table_id, PDO::PARAM_STR);
        $consulta->bindValue(':client_id', $this->client_id, PDO::PARAM_STR);
        $consulta->bindValue(':product_id', $this->product_id, PDO::PARAM_STR);
        $consulta->bindValue(':sector', $this->sector, PDO::PARAM_STR);
        $consulta->bindValue(':waitingTime',$this->waitingTime, PDO::PARAM_STR);
        $consulta->bindValue(':order_status',$this->order_status, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function GetAll()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM orders");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function GetOrderById($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM orders WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchObject('Pedido');
    }

    public static function UpdateOrder($id,$table_id,$client_id,$product_id,$sector,$waitingTime,$order_status)
    {                      
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE orders 
                                                    SET table_id = :table_id,
                                                    client_id = :client_id,
                                                    product_id = :product_id,
                                                    sector = :sector,
                                                    waitingTime = :waitingTime,
                                                    order_status = :order_status
                                                    WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->bindValue(':table_id', $table_id, PDO::PARAM_STR);
        $consulta->bindValue(':client_id', $client_id, PDO::PARAM_STR);
        $consulta->bindValue(':product_id', $product_id, PDO::PARAM_STR);
        $consulta->bindValue(':sector', $sector, PDO::PARAM_STR);
        $consulta->bindValue(':waitingTime', $waitingTime, PDO::PARAM_STR);
        $consulta->bindValue(':order_status', $order_status, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function LogicalDeleteOrderById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE orders SET order_status = :order_status WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':order_status',"DELETED", PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function DataBaseDeleteOrderById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM orders WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}