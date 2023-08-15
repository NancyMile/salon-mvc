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

    public static function forgot(){
        echo "forgot";
    }

    public static function recover(){
        echo "recover";
    }

    public static function create(){
        echo "create";
    }
}