<?php
namespace Model;

class AppointmentService extends ActiveRecord{
    protected static $tabla = 'appointments_services';
    protected static $columnasDB = ['id','service_id','appointment_id'];

    public $id;
    public $service_id;
    public $appointment_id;

    public function __construct($args =[]){
        $this->id = $args['id'] ?? null;
        $this->service_id = $args['service_id'] ?? '';
        $this->appointment_id = $args['appointment_id'] ?? '';
    }
}