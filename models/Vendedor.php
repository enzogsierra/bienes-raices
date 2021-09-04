<?php
namespace Model;

class Vendedor extends ActiveRecord
{
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    protected static $columnsDB = ["id", "nombre", "apellido", "telefono"];
    protected static $tabla = "vendedores";

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? '';
        $this->nombre = $args["nombre"] ?? '';
        $this->apellido = $args["apellido"] ?? '';
        $this->telefono = $args["telefono"] ?? '';
    }

    public function getErrors()
    {
        $errors = [];
        if(strlen($this->nombre) < 3) $errors[] = "Nombre demasiado corto";
        if(strlen($this->apellido) < 3) $errors[] = "Apellido demasiado corto";
        if(!preg_match('/[0-9]{10}/', $this->telefono)) $errors[] = "Número de teléfono no válido";
        return $errors;
    }
}