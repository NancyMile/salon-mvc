<?php
namespace Controllers;

use MVC\Router;

class loginController{

    public static function login(Router $router){
        //echo "Login";
        $router->render('auth/login');
    }

    public static function logout(){
        echo "Logout";
    }

    public static function forgot(Router $router){
        //echo "forgot";
        $router->render('auth/forgot',[]);
    }

    public static function recover(){
        echo "recover";
    }

    public static function create(Router $router){
        //echo "create";
        $router->render('auth/create-account',[]);
    }
}