<?php
namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class loginController{

    public static function login(Router $router){
        //echo "Login";
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);
            $alerts = $auth->validateLogin();
            //debuguear($auth);
            if(empty($alerts)){
                //check that user exists
                $user = User::where('email',$auth->email);
                 if($user){
                    //verify password
                    $user->checkPassAndVerified($auth->password);
                    //autenticate user
                    session_start();
                    $_SESSION['id'] = $user->id;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['login'] = true;

                    //redirect
                    if($user->admin === '1'){
                        //admin
                        header('location: /admin');
                    }else{
                        //client
                        header('location: /appointment');
                    }

                 }else{
                    User::setAlerta('error','User not found');
                 }
            }
        }

        $alerts = User::getAlertas();
        $router->render('auth/login',['alerts' => $alerts]);
    }

    public static function logout(){
        echo "Logout";
    }

    public static function forgot(Router $router){
        //echo "forgot";
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);
            $alerts = $auth->validateEmail();
            if(empty($alerts)){
                //check that email exists
                $user = User::where('email',$auth->email);

                if($user && $user->verified ==='1'){
                    //reate new token to verify user
                    $user->createToken();
                    $user->guardar();
                    //send email
                    User::setAlerta('success','Check your email');
                }else{
                    User::setAlerta('error', 'User does not exist or is not verified yet.');
                }
            }
        }
        $alerts = User::getAlertas();
        $router->render('auth/forgot',['alerts' => $alerts]);
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

                    //generate unic token
                    $user->createToken();

                    //send email
                    $email = new Email($user->name, $user->email, $user->token);
                    //send confirmation
                    $email->sendConfirmation();

                    //save user
                    $result = $user->guardar();
                    if($result){
                        header('Location: /message');
                    }
                }
            }
        }
        $router->render('auth/create-account',['user' => $user, 'alerts' => $alerts]);
    }

    public static function message(Router $router){
        $router->render('auth/message');
    }

    public static function verify(Router $router){
        $alerts = [];
        $token = s($_GET['token']);
        $user = User::where('token',$token);
        if(empty($user)){
            //error
            User::setAlerta('error','Invalid token.');
        }else{
            //update verified user
            $user->verified = 1;
            $user->token = '';
            $user->guardar();

            User::setAlerta('success','User verified.');
        }

        $alerts = User::getAlertas();
        $router->render('auth/verify-account',['alerts' => $alerts]);
    }
}