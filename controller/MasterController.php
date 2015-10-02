<?php
namespace controller;

require_once("view/NavigationView.php");
require_once("view/LayoutView.php");
require_once("view/DateTimeView.php");
require_once("controller/LoginController.php");

class MasterController{

    private $loginModel;
    private $loginView;
    private $loginController;

    function __construct() {
        //Dependency injection
        $this->loginModel = new \model\LoginModel();
        $this->loginView = new \view\LoginView($this->loginModel);
        $this->loginController = new \controller\LoginController($this->loginModel, $this->loginView);
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();
        $this->navigationView = new \view\NavigationView();
    }
    public function HandleInput(){
        if($this->navigationView->isNewUserSet()){
            //Post registration form
        }
        else{
            $this->loginController->doControl();
            $this->layoutView->newRender(false, $this->loginView, $this->dateTimeView, $this->navigationView);
        }
    }
    //If new user, load new user view
    //else, load Loginview
}