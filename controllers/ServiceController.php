<?php
namespace Controllers;

use Model\Service;
use MVC\Router;

class ServiceController{
    public static function index(Router $router){
        //echo "display service";
        session_start();

        $services = Service::all();

        $router->render('services/index',[
            'name' => $_SESSION['name'],
            'services' => $services
        ]);
    }

    public static function create(Router $router){
        //echo "create service";
        session_start();
        $service = new Service;
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $service->sincronizar($_POST);
            $alerts = $service->validateService();

            if(empty($alerts)){
                $service->guardar();
                header('location: /services');
            }
        }

        $router->render('services/create',[
            'name' => $_SESSION['name'],
            'service' => $service,
            'alerts' => $alerts
        ]);
    }

    public static function update(Router $router){
        //echo "update service";
        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }

        $router->render('services/update',[
            'name' => $_SESSION['name']
        ]);
    }

    public static function delete(Router $router){
        //echo "delete service";
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }
    }
}