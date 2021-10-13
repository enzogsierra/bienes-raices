<?php
namespace Controllers;

use Model\Admin;
use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PublicController
{
    // Pagina principal
    public static function index(Router $router)
    {
        $router->render("public/index", 
        [
            "propiedades" => Propiedad::limit(3), // Mostrar solo las primeras 3 propiedades en index
            "inicio" => true, // Indica que es la página de inicio
            "limit" => true
        ]);
    }

    // Cargar un anuncio en específico
    public static function anuncio(Router $router)
    {
        $id = filter_var($_GET["id"] ?? -1, FILTER_VALIDATE_INT);
        $propiedad = Propiedad::findById($id);
        $propiedad = array_shift($propiedad);

        if($propiedad) // Si el anuncio existe
        {
            $router->render("public/anuncio",
            [
                "propiedad" => $propiedad
            ]);
        }
        else $router->render("public/404");

    }

    // Cargar la pagina de /anuncios
    public static function anuncios(Router $router)
    {
        $router->render("public/anuncios",
        [
            "propiedades" => Propiedad::all()
        ]);
    }


    // Misc
    public static function nosotros(Router $router)
    {
        $router->render("public/nosotros");
    }

    public static function blog(Router $router)
    {
        $router->render("public/blog");
    }

    public static function entrada(Router $router)
    {
        $router->render("public/entrada");
    }


    // Pagina de /contacto
    public static function contacto(Router $router)
    {
        $form_res = -1; // Almacena si el email pudo ser enviado

        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = "smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = "0f0321750051f5";
            $mail->Password = "c97752abab6671";
            $mail->SMTPSecure = "tls";
            $mail->Port = 25;

            // Configurar email
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress("enzometlc@hotmail.com", "BienesRaices.com");
            $mail->Subject = "Mensaje nuevo";

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8"; // Habilitar caracteres especiales

            $mail->Body = "<html><p>Tienes un mensaje nuevo</p></html>";
            $mail->AltBody = "Sample text";

            if($mail->send()) $form_res = 1;
            else $form_res = 0;
        }

        $router->render("public/contacto", 
        [
            "form_res" => $form_res
        ]);
    }

    
    // Pagina para loguear como administrador
    public static function login(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $login = new Admin($_POST);
            $errores = $login->getErrors();

            if(empty($errores))
            {
                $data = Admin::findValue("user", $login->user);
                $data = array_shift($data);

                if($data) // Usuario encontrado
                {
                    if(password_verify($login->password, $data->password)) // Verificar contraseña con hash
                    {
                        session_start();
                        $_SESSION["admin"] = true;
                        header("Location: /admin"); // Redireccionar a la página administrativa
                    }
                    else $errores[] = "Contraseña incorrecta";
                }
                else $errores[] = "Usuario no encontrado";
            }
        }

        $router->render("public/login",
        [
            "errores" => $errores ?? NULL
        ]);
    }

    public static function logout(Router $router)
    {
        $admin = $_SESSION["admin"] ?? false;
        if($admin === true) // Es administrador
        {
            $_SESSION = [];
            header("Location: /"); // Eliminar la sesión y redirigir al usuario a la página principal
        }
        else $router->render("public/404"); // Si el usuario no es administrador, mostrar la página 404
    }

    public static function usuario()
    {
        
    }
}