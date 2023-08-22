<?php
namespace Controllers;

use MVC\Router;

class ServiceController{
    public static function index(Router $router){
        //echo "display service";
        $router->render('services/index',[]);
    }

    public static function create(Router $router){
        //echo "create service";
        if($_SERVER['REQUEST_MEETHOD'] === 'POST'){

        }
    }

    public static function update(Router $router){
        //echo "update service";
        if($_SERVER['REQUEST_MEETHOD'] === 'POST'){
            
        }
    }

    public static function delete(Router $router){
        //echo "delete service";
        if($_SERVER['REQUEST_MEETHOD'] === 'POST'){
            
        }
    }
}