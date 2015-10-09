<?php
namespace controller;

class RegisterController{

    private $view;
    private $usersList;
    private $loginModel;

    public function __construct(\view\RegistrationView $view, \model\UsersList $usersList, \model\LoginModel $loginModel) {
        $this->view =  $view;
        $this->usersList = $usersList;
        $this->loginModel = $loginModel;
    }
    public function doRegistration(){
        if($this->view->userWantsToRegister()){
            $rc = $this->view->getRegistrationCredentials();
            if($this->usersList->doRegistration($rc)){
                return true;
            }
            else{
                $this->view->setRegistrationFail();
                return false;
            }

        }
    }
}