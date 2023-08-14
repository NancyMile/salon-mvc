<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\loginController;
use MVC\Router;

$router = new Router();

//init sesion
$router->get('/',[loginController::class,'login']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();