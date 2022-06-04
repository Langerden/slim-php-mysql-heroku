<?php

class Mesa
{
    public $id;
    public $client_id;
    public $waiter_id;
    public $table_status;
    public $capacity;
    public $invoice;


    public function CreateTable()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO tables (client_id,waiter_id,table_status,capacity,invoice) 
                                                                  VALUES (:client_id,:waiter_id,:table_status,:capacity,:invoice)");
        $consulta->bindValue(':client_id', $this->client_id, PDO::PARAM_STR);
        $consulta->bindValue(':waiter_id', $this->waiter_id, PDO::PARAM_STR);
        $consulta->bindValue(':table_status',"AVAILABLE", PDO::PARAM_STR);
        $consulta->bindValue(':capacity', $this->capacity, PDO::PARAM_STR);
        $consulta->bindValue(':invoice',$this->invoice, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function GetAll()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM tables");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function GetTableById($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM tables WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchObject('Mesa');
    }

    public static function UpdateTable($id,$client_id,$waiter_id,$table_status,$capacity,$invoice)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE tables 
                                                    SET client_id = :client_id,
                                                        waiter_id = :waiter_id,
                                                        table_status = :table_status,
                                                        capacity = :capacity,
                                                        invoice = :invoice
                                                    WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->bindValue(':client_id', $client_id, PDO::PARAM_STR);
        $consulta->bindValue(':waiter_id', $waiter_id, PDO::PARAM_STR);
        $consulta->bindValue(':table_status', $table_status, PDO::PARAM_STR);
        $consulta->bindValue(':capacity', $capacity, PDO::PARAM_STR);
        $consulta->bindValue(':invoice', $invoice, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function LogicalDeleteTableById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE tables SET table_status = :table_status WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':table_status',"NOT AVAILABLE", PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function DataBaseDeleteTableById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM tables WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}