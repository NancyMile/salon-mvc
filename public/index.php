<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\loginController;
use MVC\Router;

$router = new Router();

//init sesion
$router->get('/',[loginController::class,'login']);
$router->post('/',[loginController::class,'login']);
$router->get('/logout',[loginController::class,'logout']);

//recover pass
$router->get('/forgot',[loginController::class,'forgot']);
$router->post('/forgot',[loginController::class,'forgot']);
$router->get('/recover',[loginController::class,'recover']);
$router->post('/recover',[loginController::class,'recover']);

//create account
$router->get('/create-account',[loginController::class,'create']);
$router->post('/create-account',[loginController::class,'create']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();