<?php
namespace Controllers;

use Model\AdminAppointment;
use MVC\Router;

class AdminController {

    public static function index(Router $router){
        session_start();
        isAdmin();

        $date = $_GET['date'] ?? date('Y-m-d');
        //check that is a valid date
        $verifyDate = explode('-',$date);
        //use chek date to verify is is a valis date, takes m,d,Y
        if(!checkdate($verifyDate[1],$verifyDate[2],$verifyDate[0])){
            //no valid
            header('location:/');
        }

        //querying db
        $query = "SELECT appointments.id, appointments.time, CONCAT( users.name, ' ', users.lastname) as client, ";
        $query .= " users.email, users.phone, services.name as service, services.price  ";
        $query .= " FROM appointments  ";
        $query .= " LEFT OUTER JOIN users ";
        $query .= " ON appointments.user_id=users.id  ";
        $query .= " LEFT OUTER JOIN appointments_services ";
        $query .= " ON appointments_services.appointment_id=appointments.id ";
        $query .= " LEFT OUTER JOIN services ";
        $query .= " ON services.id=appointments_services.service_id ";
        $query .= " WHERE date =  '$date' ";

        $appointments = AdminAppointment::SQL($query);
        //debuguear($appointments);

        $router->render('admin/index',[
            'name' => $_SESSION['name'],
            'appointments' => $appointments,
            'date' => $date
        ]);
    }
}