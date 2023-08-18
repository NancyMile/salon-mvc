<?php
namespace Controllers;

use Model\User;
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
        $user = new User($_POST);

        //alerts
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //echo "Create sent";
            $user->sincronizar($_POST);

            $alerts = $user->validateNewAccount();
            //check that alerts is empty
            if(empty($alerts)){
                $result = $user->userExists();

                if($result->num_rows){
                    $alerts = User::getAlertas();
                }else{
                    //debuguear("User doesn't exists.");
                    $user->hashPassword();
                }
            }
        }
        $router->render('auth/create-account',['user' => $user, 'alerts' => $alerts]);
    }
}