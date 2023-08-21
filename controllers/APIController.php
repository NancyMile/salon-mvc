<?php
namespace Controllers;

use Model\Appointment;
use Model\Service;

class APIController{
    public static function index(){
       // echo "From API  Index";
       $services = Service::all();
       echo json_encode($services);
    }

    public static function save(){
        $appointment = new Appointment($_POST);

        $result = $appointment->guardar();

        // $response = [
        //     'appointment' => $appointment
        // ];

        echo json_encode($result);
    }
}