<?php

namespace Model;

class AdminAppointment extends ActiveRecord {
    protected static $tabla = 'appointments_services';
    protected static $columnasDB = ['id','time','client','email','phone','service','price'];

    public $id;
    public $time;
    public $client;
    public $email;
    public $phone;
    public $service;
    public $price;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->time = $args['time'] ?? '';
        $this->client = $args['client'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->service = $args['service'] ?? '';
        $this->price = $args['price'] ?? '';
    }
}