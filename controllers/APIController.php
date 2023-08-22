<?php
namespace Controllers;

use Model\Appointment;
use Model\AppointmentService;
use Model\Service;

class APIController{
    public static function index(){
       // echo "From API  Index";
       $services = Service::all();
       echo json_encode($services);
    }

    public static function save(){
        //save appointment and returns the id
        $appointment = new Appointment($_POST);
        $result = $appointment->guardar();

        $id = $result['id'];

        //save the appointment and services
        $idServices = explode(',',$_POST['services']);

        foreach ($idServices as $idService){
            $args = [
                'appointment_id' => $id,
                'service_id' =>  $idService
            ];

            $appointmentService = new AppointmentService($args);
            $appointmentService->guardar();
        }

        //return a response
        echo json_encode(['result' => $result['resultado']]);
    }
}