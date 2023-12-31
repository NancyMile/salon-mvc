<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

 class Email{

    public $email;
    public $name;
    public $token;

    public function __construct($email, $name, $token){
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }


    public function sendConfirmation(){
        //create object email
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV['EMAIL_HOST'];
        $email->SMTPAuth = true;
        $email->Port = $_ENV['EMAIL_PORT'];
        $email->Username = $_ENV['EMAIL_USER'];
        $email->Password = $_ENV['EMAIL_PASSWORD'];

        $email->setFrom('salonAccount@test.com');
        $email->addAddress('salonAccount@tests.com','salon.com');
        $email->Subject = 'Confirm account';

        //set HTML
        $email->isHTML(TRUE);
        $email-> CharSet = 'UFT-8';

        $content = "<html>";
        $content .= "<p> Hi: ".$this->name." Please confirm by click following link</p>";
        $content .= "<a href='".$_ENV['APP_URL']."/verify-account?token=".$this->token."'>Confirm Acoount</a>";
        $content .= "<p>If you did not create a new account, please ignore the email.</p>";
        $content .= "</html>";
        $email->Body = $content;

        //send email
        $email->send();
    }

    public function sendInstructions(){
        //create object email
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV['EMAIL_HOST'];
        $email->SMTPAuth = true;
        $email->Port = $_ENV['EMAIL_PORT'];
        $email->Username = $_ENV['EMAIL_USER'];
        $email->Password = $_ENV['EMAIL_PASSWORD'];

        $email->setFrom('salonAccount@test.com');
        $email->addAddress('salonAccount@tests.com','salon.com');
        $email->Subject = 'Reset Password';

        //set HTML
        $email->isHTML(TRUE);
        $email-> CharSet = 'UFT-8';

        $content = "<html>";
        $content .= "<p> Hi: ".$this->name." Reset password by click following link</p>";
        $content .= "<a href='".$_ENV['APP_URL']."/recover?token=".$this->token."'>Reset Password</a>";
        $content .= "<p>If you did not create a new account, please ignore the email.</p>";
        $content .= "</html>";
        $email->Body = $content;

        //send email
        $email->send();
    }
 }