<?php
namespace Model;

class Propiedad extends ActiveRecord
{
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;
    protected static $columnsDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedorId"];
    protected static $tabla = "propiedades";

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? '';
        $this->titulo = $args["titulo"] ?? '';
        $this->precio = $args["precio"] ?? '';
        $this->imagen = $args["imagen"] ?? '';
        $this->descripcion = $args["descripcion"] ?? '';
        $this->habitaciones = $args["habitaciones"] ?? '';
        $this->wc = $args["wc"] ?? '';
        $this->estacionamiento = $args["estacionamiento"] ?? '';
        $this->creado = date("Y/m/d");
        $this->vendedorId = $args["vendedorId"] ?? '';
    }

    // Subida de imagen
    public function setImageName($name)
    {
        $this->imagen = $name;
    }

    // Errores
    public function getErrors()
    {
        $errors = [];
        if(!$this->titulo) $errors[] = "Debes añadir un título";
        if(!($this->precio && filter_var($this->precio, FILTER_VALIDATE_INT))) $errors[] = "Debes añadir un precio";
        if(strlen($this->descripcion) < 30) $errors[] = "La descripción debe tener al menos 30 caracteres";
        if(!($this->habitaciones && filter_var($this->habitaciones, FILTER_VALIDATE_INT))) $errors[] = "El número de habitaciones es obligatorio";
        if(!($this->wc && filter_var($this->wc, FILTER_VALIDATE_INT))) $errors[] = "El número de baños es obligatorio";
        if(!($this->estacionamiento && filter_var($this->estacionamiento, FILTER_VALIDATE_INT))) $errors[] = "El número de estacionamientos es obligatorio";
        if(!($this->vendedorId && filter_var($this->vendedorId, FILTER_VALIDATE_INT))) $errors[] = "Debes seleccionar un vendedor";
        if(!($this->imagen)) $errors[] = "Debes seleccionar una imagen";
        return $errors;
    }
}