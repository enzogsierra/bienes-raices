<?php

namespace Model;

class ActiveRecord
{
    protected static $columnsDB = [];
    protected static $tabla = "";
    
    
    // Metodos para la db
    protected static $db;
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function save()
    {
        // Sanitizar datos
        $input = [];
        foreach(static::$columnsDB as $column) // Iteramos el array $columnsDB
        {
            if($column === "id") continue;
            $input[$column] = self::$db->escape_string($this->$column);
        }

        // Insertar en la db
        return (self::$db->query("INSERT INTO " . static::$tabla . " (" . join(", ", array_keys($input)) . ") VALUES ('" . join("', '", array_values($input)) . "')"));
    }

    public function update()
    {
        $input = [];
        $str = [];
        foreach(static::$columnsDB as $column) // Iteramos el array $columnsDB
        {
            if($column === "id") continue;
            $input[$column] = self::$db->escape_string($this->$column);
        }
        foreach($input as $key => $value)
        {
            $str[] = "{$key} = '{$value}'";
        }

        return self::$db->query("UPDATE " . static::$tabla . " SET " . join(", ", $str) . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1");
    }

    public function delete()
    {
        if(isset($this->imagen)) unlink($_SERVER["DOCUMENT_ROOT"] . "\\imagenes\\" . $this->imagen);
        return self::$db->query("DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1");
    }


    // query
    public static function all()
    {
        return self::consultarSQL("SELECT * FROM " . static::$tabla);
    }
    public static function findById($id)
    {
        return self::consultarSQL("SELECT * FROM " . static::$tabla . " WHERE id = ${id}");
    }
    public static function findValue($column, $value)
    {
        return self::consultarSQL("SELECT * FROM " . static::$tabla . " WHERE ${column} = '${value}' LIMIT 1");
    }
    public static function limit($limit)
    {
        return self::consultarSQL("SELECT * FROM " . static::$tabla . " LIMIT ${limit}");
    }
    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query); // Consultar a la db
        $array = [];
        while($registro = $resultado->fetch_assoc()) // Iterar sobre cada resultado
        {
            $array[] = static::createObject($registro);
        }

        $resultado->free(); // Liberar memoria
        return $array; // Retornar resultados
    }

    public static function createObject($registro)
    {
        $object = new static;
        foreach($registro as $key => $value)
        {
            if(property_exists($object, $key)) $object->$key = $value;
        }
        return $object;
    }
    

    // Sicronizar el objeto en la memoria con los valores editados
    public function sync($args = [])
    {
        foreach($args as $key => $value)
        {
            if(property_exists($this, $key) && !is_null($value)) $this->$key = $value;
        }
    }
}