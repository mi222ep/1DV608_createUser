<?php
namespace controller;

require_once("view/NavigationView.php");
require_once("view/LayoutView.php");
require_once("view/DateTimeView.php");
require_once("controller/LoginController.php");
require_once("view/RegistrationView.php");

class MasterController{

    private $loginModel;
    private $loginView;
    private $loginController;
    private $navigationView;
    private $registrationView;

    function __construct() {
        //Dependency injection
        $this->loginModel = new \model\LoginModel();
        $this->loginView = new \view\LoginView($this->loginModel);
        $this->loginController = new \controller\LoginController($this->loginModel, $this->loginView);
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();
        $this->navigationView = new \view\NavigationView();
        $this->registrationView = new \view\RegistrationView();
    }
    public function HandleInput(){
        if($this->navigationView->isNewUserSet()){
            //Registration controller, doControl
        }
        else{
            $this->loginController->doControl();
        }
        $this->layoutView->render($this->loginModel->isLoggedIn($this->loginView->getUserClient()), $this->loginView, $this->dateTimeView, $this->navigationView, $this->registrationView);

    }
}