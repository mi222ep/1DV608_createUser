<?php
namespace controller;

class RegisterController{

    private $view;

    public function __construct(\view\RegistrationView $view) {
        $this->view =  $view;
    }
    public function doRegistration(){
        if($this->view->userWantsToRegister()){
            $this->view->setRegistrationFail();
        }
    }
}