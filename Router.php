<?php
namespace MVC;

class Router
{
    public $routes_GET = [];
    public $routes_POST = [];

    public function get($url, $fn)
    {
        $this->routes_GET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->routes_POST[$url] = $fn;
    }

    public function checkRoutes()
    {
        $url = $_SERVER["PATH_INFO"] ?? "/";

        // Rutas protegidas
        session_start();
        $admin = $_SESSION["admin"] ?? false;
        if($admin === false) // Usuario no autenticado como administrador
        {
            // Paginas protegidas
            if(strpos($url, "/admin") !== false) 
            {
                $this->render("public/404");
                exit;
            }
            if(strpos($url, "/propiedades") !== false) 
            {
                $this->render("public/404");
                exit;
            }
            if(strpos($url, "/vendedores") !== false) 
            {
                $this->render("public/404");
                exit;
            }
        }

        // Verificar si la ruta existe y cargar la pagina
        if($_SERVER["REQUEST_METHOD"] === "GET") $fn = $this->routes_GET[$url] ?? NULL;
        else $fn = $this->routes_POST[$url] ?? NULL;

        if($fn) call_user_func($fn, $this); // Llamar al controlador
        else $this->render("public/404"); // Pagina no existente
    }

    public function render($view, $params = [])
    {
        foreach($params as $key => $value)
        {
            $$key = $value; // $$ = variable de variable
        }

        ob_start(); // Output buffering - cache
        include __DIR__ . "/views/$view.php"; // Cargar la vista
        $contenido = ob_get_clean(); // Almacenar la vista en $contenido
        include __DIR__ . "/views/layout.php"; // Cargar el layout y pasarle la variable $contenido (vista)
    }
}