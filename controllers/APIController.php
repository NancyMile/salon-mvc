<?php
namespace Controllers;

use Model\Service;

class APIController{
    public static function index(){
       // echo "From API  Index";
       $services = Service::all();
       echo json_encode($services);
    }

    public static function save(){
        $response = [
            'message' => 'all good'
        ];

        echo json_encode($response);
    }
}