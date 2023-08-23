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

        if(!is_numeric($_GET['id'])) return;
        $service = Service::find($_GET['id']);
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $service->sincronizar($_POST);
            $alerts = $service->validateService();

            if(empty($alerts)){
                $service->guardar();
                header('location: /services');
            }
        }

        $router->render('services/update',[
            'name' => $_SESSION['name'],
            'service' => $service,
            'alerts' => $alerts
        ]);
    }

    public static function delete(){
        //echo "delete service";
        if(!is_numeric($_POST['id'])) return;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $service = Service::find($_POST['id']);
            $service->eliminar();
            header('location: /services');
        }
    }
}