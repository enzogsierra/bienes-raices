<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all(); // Cargar todas las propiedades
        $vendedores = Vendedor::all(); // Cargar todos los vendedores
        $router->render("propiedades/admin", 
        [
            "propiedades" => $propiedades,
            "vendedores" => $vendedores,
            "success" => intval($_GET["success"] ?? -1)
        ]);
    }


    public static function crear(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST") // Formulario enviado para crear una propiedad
        {
            $propiedad = new Propiedad($_POST["propiedad"] ?? ""); // Creamos una instancía y llenamos sus atributos
            $propiedad->setImageName($_FILES["propiedad"]["tmp_name"]["imagen"] ?? NULL);
            $errores = $propiedad->getErrors();

            if(empty($errores)) // Si no hay errores, insertar en la db
            {
                // Subir imagen
                $folder_path = $_SERVER["DOCUMENT_ROOT"] . "\\imagenes\\"; // Obtener la ruta de la carpeta de imagenes
                $image_name = md5(uniqid(rand(), true)) . ".jpg"; // Generar un string random único - nombre del archivo de imagen
                if(!is_dir($folder_path)) mkdir($folder_path); // Si no existe la carpeta de imagenes, crearla
                
                // Realizar un resize a la imagen
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600); // 800x600 px
                $image->save($folder_path . $image_name); // Guardar la imagen
                $propiedad->setImageName($image_name); // Almacenar el nuevo nombre de la imagen en el objeto
                
                // Guardar db
                if($propiedad->save()) 
                {
                    // Redireccionar al usuario a la pagina /admin/ para evitar que se envíen datos duplicados - no funciona si hay HTML previo a este código
                    // Query String - URL con argumentos/parametros
                    header("Location: /admin?success=1");
                }
                else $errores[] = "Hubo un error al añadir la propiedad a la base de datos."; 
            }
            else // Formulario no válido - resetear algunos valores
            {
                $propiedad->setImageName(NULL);
                $propiedad->vendedorId = NULL;
            }
        }
        else $propiedad = new Propiedad(); // Método GET - creamos una una instancia vacía

        $vendedores = Vendedor::all(); // Mostramos todos los vendedores
        $router->render("propiedades/crear", 
        [
            "propiedad" => $propiedad, 
            "vendedores" => $vendedores,
            "errores" => $errores ?? NULL
        ]);
    }


    public static function editar(Router $router)
    {
        // Validar id
        $id = filter_var($_GET["id"] ?? "NaN", FILTER_VALIDATE_INT);
        if($id === false) header("Location: /admin?success=0");

        $propiedad = Propiedad::findById($id);
        $propiedad = array_shift($propiedad);
        if(!$propiedad) header("Location: /admin?success=0"); // ID de propiedad no válida

        // ID de propiedad válida
        if($_SERVER["REQUEST_METHOD"] === "POST") // Actualizar propiedad
        {
            $propiedad->sync($_POST["propiedad"] ?? ""); // Sincronizar $propiedad con los nuevos datos
            $errores = $propiedad->getErrors();

            // Datos validados, insertar en la db
            if(empty($errores))
            {
                // Verificar si está actualizando la imagen
                if($_FILES["propiedad"]["name"]["imagen"])
                {
                    $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
                    $image->save($_SERVER["DOCUMENT_ROOT"] . "\\imagenes\\" . $propiedad->imagen);
                }

                // Actualizar db
                if($propiedad->update()) header("Location: /admin?success=2");
                else $errores[] = "Hubo un error en la base de datos al actualizar la propiedad.";
            }
        }

        // Mostrar
        $vendedores = Vendedor::all();
        $router->render("propiedades/editar",
        [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores ?? NULL
        ]);
    }


    public static function eliminar(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {   
            // Verificar id
            $id = filter_var($_POST["id"] ?? "NaN", FILTER_VALIDATE_INT);
            if($id === false) header("Location: /admin?success=0"); // id no válido


            // ID válida
            if(($_POST["tipo"] ?? "") === "propiedad") // tipo válido
            {
                $propiedad = Propiedad::findById($id);
                $propiedad = array_shift($propiedad);

                if($propiedad) // Propiedad válida
                {
                    if($propiedad->delete()) header("Location: /admin?success=3"); // Eliminado correctamente de la db
                    else header("Location: /admin?success=4"); // Error inesperado
                }
                else header("Location: /admin?success=0"); // Propiedad no válida
            }
            else header("Location: /admin?success=0"); // "Tipo" no válido
        }
        else header("Location: /admin"); // Si se accede a la página con método GET
    }
}
?>
