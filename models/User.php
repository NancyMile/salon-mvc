<?php
 namespace Model;

 class User extends ActiveRecord {
    //data base
    protected static $tabla = 'Users';
    protected static $columnasDB = ['id','name','lastname','email','password','phone','admin','verified','token'];

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $verified;
    public $token;
    
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->verified = $args['verified'] ?? null;
        $this->token = $args['token'] ?? '';
    }

    //validation messages creating an account
    public function validateNewAccount(){
        if(!$this->name){
            self::$alertas['error'][] = 'Please add name.';
        }
        if(!$this->lastname){
            self::$alertas['error'][] = 'Please add lastname';
        }
        if(!$this->phone){
            self::$alertas['error'][] = 'Please add phone';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'Please add email';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'Please add password';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'Password should have min 6 characters';
        }

        return self::$alertas;
    }
 }