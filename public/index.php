<?php
require_once __DIR__ . "/../include.php";

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PublicController;

$router = new Router();

// Paginas publicas
$router->get("/", [PublicController::class, "index"]);
$router->get("/anuncio", [PublicController::class, "anuncio"]);
$router->get("/anuncios", [PublicController::class, "anuncios"]);
$router->get("/blog", [PublicController::class, "blog"]);
$router->get("/contacto", [PublicController::class, "contacto"]);
$router->post("/contacto", [PublicController::class, "contacto"]);
$router->get("/entrada", [PublicController::class, "entrada"]);
$router->get("/nosotros", [PublicController::class, "nosotros"]);

// Admin
$router->get("/login", [PublicController::class, "login"]);
$router->post("/login", [PublicController::class, "login"]);
$router->get("/logout", [PublicController::class, "logout"]);


// Propiedades
$router->get("/admin", [PropiedadController::class, "index"]);
$router->get("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->get("/propiedades/editar", [PropiedadController::class, "editar"]);
$router->post("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->post("/propiedades/editar", [PropiedadController::class, "editar"]);
$router->post("/propiedades/eliminar", [PropiedadController::class, "eliminar"]);

// Vendedores
$router->get("/vendedores/crear", [VendedorController::class, "crear"]);
$router->get("/vendedores/editar", [VendedorController::class, "editar"]);
$router->post("/vendedores/crear", [VendedorController::class, "crear"]);
$router->post("/vendedores/editar", [VendedorController::class, "editar"]);
$router->post("/vendedores/eliminar", [VendedorController::class, "eliminar"]);

$router->checkRoutes();