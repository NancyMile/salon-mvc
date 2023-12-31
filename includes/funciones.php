<?php

use Controllers\loginController;

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//check the user is authenticated
function isAuth(){
    if(!isset($_SESSION['login'])){
        header('location: /');
    }
}

function isAdmin():void{
    if(!isset($_SESSION['admin'])){
        header('location: /');
    }
}

function lastElement(string $actual, string $next): bool {
    if($actual !== $next){
        return true;
    }
    return false;
}