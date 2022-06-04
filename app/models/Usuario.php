<?php

class Usuario
{
    public $id;
    public $username;
    public $lastname;
    public $userPassword;
    public $user_type;
    public $active;
    public $email;

    public function CreateUser()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO users (username,lastname,userPassword,user_type,active,email) 
                                                                     VALUES (:username,:lastname,:userPassword,:user_type,:active,:email)");        $claveHash = password_hash($this->userPassword, PASSWORD_DEFAULT);
        $consulta->bindValue(':username', $this->username, PDO::PARAM_STR);
        $consulta->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $consulta->bindValue(':userPassword',$claveHash, PDO::PARAM_STR);
        $consulta->bindValue(':user_type', $this->user_type, PDO::PARAM_STR);
        $consulta->bindValue(':active',"YES", PDO::PARAM_STR);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function GetAll()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id,username,lastname,userPassword,user_type,active,email
                                                        FROM users");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetUserById($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id,username,lastname,userPassword,user_type,active,email
                                                        FROM users 
                                                        WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }


    public static function UpdateUser($id,$username,$lastname,$userPassword,$user_type,$active,$email)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE users 
                                                    SET username = :username,
                                                        lastname = :lastname,
                                                        userPassword = :userPassword,
                                                        user_type = :user_type,
                                                        active = :active,
                                                        email = :email
                                                    WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->bindValue(':username', $username, PDO::PARAM_STR);
        $consulta->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $consulta->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);
        $consulta->bindValue(':user_type', $user_type, PDO::PARAM_STR);
        $consulta->bindValue(':active', $active, PDO::PARAM_STR);
        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function LogicalDeleteUserById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE users SET active = :active WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':active',"NO", PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function DataBaseDeleteUserById($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM users WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }
}