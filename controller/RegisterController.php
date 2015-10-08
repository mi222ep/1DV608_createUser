<?php
namespace controller;

class RegisterController{

    private $view;
    private $usersList;

    public function __construct(\view\RegistrationView $view, \model\UsersList $usersList) {
        $this->view =  $view;
        $this->usersList = $usersList;
    }
    public function doRegistration(){
        if($this->view->userWantsToRegister()){
            $rc = $this->view->getRegistrationCredentials();
            if($this->usersList->doRegistration($rc)){
            }
            $this->view->setRegistrationFail();
        }
    }
}