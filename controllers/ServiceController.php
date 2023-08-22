<?php
namespace Controllers;

use MVC\Router;

class ServiceController{
    public static function index(Router $router){
        //echo "display service";
        session_start();


        $router->render('services/index',[
            'name' => $_SESSION['name']
        ]);
    }

    public static function create(Router $router){
        //echo "create service";
        session_start();

        if($_SERVER['REQUEST_MEETHOD'] === 'POST'){

        }

        $router->render('services/create',[
            'name' => $_SESSION['name']
        ]);
    }

    public static function update(Router $router){
        //echo "update service";
        session_start();

        if($_SERVER['REQUEST_MEETHOD'] === 'POST'){
            
        }

        $router->render('services/update',[
            'name' => $_SESSION['name']
        ]);
    }

    public static function delete(Router $router){
        //echo "delete service";
        if($_SERVER['REQUEST_MEETHOD'] === 'POST'){
            
        }
    }
}