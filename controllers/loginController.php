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
                        $_SESSION['admin'] = $user->admin ?? null;
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
        //echo "Logout";
        session_start();
        $_SESSION = [];
        //debuguear($_SESSION);
        header('location: /');
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
                    $email = new Email($user->name, $user->email, $user->token);
                    $email->sendInstructions();

                    User::setAlerta('success','Check your email');
                }else{
                    User::setAlerta('error', 'User does not exist or is not verified yet.');
                }
            }
        }
        $alerts = User::getAlertas();
        $router->render('auth/forgot',['alerts' => $alerts]);
    }

    public static function recover(Router $router){
        //echo "recover";
        $alerts = [];
        $error = false;

        $token = s($_GET['token']);
        //search user by token
        $user = User::where('token',$token);

        if(empty($user)){
            User::setAlerta('error','Invakid token');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $password = new User($_POST);
            $alerts = $password->validatePassword();

            if(empty($alerts)){
                $user->password = null;

                $user->password = $password->password;
                $user->hashPassword();
                $user->token = null;

                $result = $user->guardar();

                if ($result){
                    header('location: /');
                }
            }
        }
        $alerts = User::getAlertas();
        $router->render('auth/recover',['alerts' => $alerts, 'error' => $error]);
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