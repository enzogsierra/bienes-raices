<?php
namespace Model;

class Admin extends ActiveRecord
{
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "user", "password"];

    public $id;
    public $user;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? NULL;
        $this->user = $args["user"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function getErrors()
    {
        $errors = [];
        if(!$this->user) $errors[] = "Inserte un nombre de usuario";
        if(!$this->password) $errors[] = "Inserte una contraseña";
        return $errors;
    }
}