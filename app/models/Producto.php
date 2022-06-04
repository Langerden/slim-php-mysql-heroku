<?php

class Producto
{
    public $id;
    public $productName;
    public $price;
    public $product_type;
    public $active;

    public function CreateProduct()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO products (productName,price,product_type,active) 
                                                                     VALUES (:productName,:price,:product_type,:active)");
        $consulta->bindValue(':productName', $this->productName, PDO::PARAM_STR);
        $consulta->bindValue(':price', $this->price, PDO::PARAM_STR);
        $consulta->bindValue(':product_type', $this->product_type, PDO::PARAM_STR);
        $consulta->bindValue(':active',"ACTIVO", PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function GetAll()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM products");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    public static function GetProductById($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM products WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchObject('Producto');
    }

    public static function UpdateProduct($id,$productName,$price,$product_type,$active)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE products 
                                                    SET productName = :productName,
                                                        price = :price,
                                                        product_type = :product_type,
                                                        active = :active
                                                    WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->bindValue(':productName', $productName, PDO::PARAM_STR);
        $consulta->bindValue(':price', $price, PDO::PARAM_STR);
        $consulta->bindValue(':product_type', $product_type, PDO::PARAM_STR);
        $consulta->bindValue(':active', $active, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function LogicalDeleteProductById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE products SET active = :active WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':active',"NO", PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function DataBaseDeleteProductById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM products WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}