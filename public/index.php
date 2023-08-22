<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\loginController;
use Controllers\ServiceController;
use Controllers\AppointmentController;

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

//verify account
$router->get('/verify-account',[loginController::class,'verify']);
//confirm account
$router->get('/message',[loginController::class,'message']);

//private
$router->get('/appointment',[AppointmentController::class,'index']);
$router->get('/admin',[AdminController::class,'index']);

//API appointments

$router->get('/api/services',[APIController::class,'index']);
$router->post('/api/services',[APIController::class,'save']);
$router->post('/api/delete',[APIController::class,'delete']);

//CRUD services
$router->get('/services',[ServiceController::class,'index']);
$router->get('/services/create',[ServiceController::class,'create']);
$router->post('/services/create',[ServiceController::class,'create']);
$router->get('/services/update',[ServiceController::class,'update']);
$router->post('/services/update',[ServiceController::class,'update']);
$router->post('/services/delete',[ServiceController::class,'delete']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();