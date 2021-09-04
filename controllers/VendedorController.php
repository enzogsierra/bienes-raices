<?php
namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    // Crear nuevo vendedor
    public static function crear(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $vendedor = new Vendedor($_POST["vendedor"] ?? "");
            $errores = $vendedor->getErrors();

            if(empty($errores))
            {
                if($vendedor->save())  header("Location: /admin?success=1");
                else $errores[] = "Hubo un error al añadir la propiedad a la base de datos.";
            }
        }
        else $vendedor = new Vendedor(); // Se carga la página en método GET - crear una instancía vacía

        $router->render("vendedores/crear",
        [
            "vendedor" => $vendedor,
            "errores" => $errores ?? NULL
        ]);
    }


    public static function editar(Router $router)
    {
        // Validar datos
        $id = filter_var($_GET["id"] ?? "NaN", FILTER_VALIDATE_INT);
        if($id === false) header("Location: /admin?success=0"); // Si la variable no es un entero, redireccionar

        $vendedor = Vendedor::findById($id);
        $vendedor = array_shift($vendedor);
        if(!$vendedor) header("Location: /admin?success=0"); // Si el vendedor no existe, redireccionar

        // Datos validados
        if($_SERVER["REQUEST_METHOD"] === "POST") // Actualizar vendedor
        {
            $vendedor->sync($_POST["vendedor"] ?? "");
            $errores = $vendedor->getErrors();
            if(empty($errores))
            {
                if($vendedor->update()) header("Location: /admin?success=2");
                else $errores[] = "Hubo un error en la base de datos al actualizar el vendedor.";
            }
        }
        
        $router->render("vendedores/editar",
        [
            "vendedor" => $vendedor,
            "errores" => $errores ?? NULL
        ]);
    }

    // Eliminar un vendedor
    public static function eliminar(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {   
            // Verificar id
            $id = filter_var($_POST["id"] ?? "NaN", FILTER_VALIDATE_INT);
            if($id === false) header("Location: /admin?success=0"); // id no válido

            // ID válida
            if(($_POST["tipo"] ?? "") === "vendedor") // tipo válido
            {
                $vendedor = Vendedor::findById($id);
                $vendedor = array_shift($vendedor);

                if($vendedor) // Vendedor válido
                {
                    if($vendedor->delete()) header("Location: /admin?success=3"); // Eliminado correctamente de la db
                    else header("Location: /admin?success=4"); // Error inesperado
                }
                else header("Location: /admin?success=0"); // Vendedor no válido
            }
            else header("Location: /admin?success=0"); // No es un "tipo" válido
        }
        else header("Location: /admin"); // Si se accede a la página con método GET
    }
}