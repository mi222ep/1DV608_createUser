<?php
namespace controller;

require_once("view/NavigationView.php");
require_once("view/LayoutView.php");
require_once("view/DateTimeView.php");
require_once("controller/LoginController.php");
require_once("controller/RegisterController.php");
require_once("view/RegistrationView.php");

class MasterController{

    private $loginModel;
    private $loginView;
    private $loginController;
    private $navigationView;
    private $registrationView;
    private $registrationController;
    private $usersList;

    function __construct() {
        //$this->mysqli = new \mysqli('logintest-202794.mysql.binero.se', '202794_av32846', '12345qwert', '202794-logintest');
        $this->mysqli = new \mysqli("localhost", "test", "123456", "users");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $this->usersList = new \model\UsersList($this->mysqli);
        $this->loginModel = new \model\LoginModel($this->mysqli);
        $this->loginView = new \view\LoginView($this->loginModel);
        $this->loginController = new \controller\LoginController($this->loginModel, $this->loginView);
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();
        $this->navigationView = new \view\NavigationView();
        $this->registrationView = new \view\RegistrationView($this->usersList);
        $this->registrationController = new \controller\RegisterController($this->registrationView);
    }
    public function HandleInput(){
        if($this->navigationView->isNewUserSet()){
            $this->registrationController->doRegistration();
        }
        else{
            $this->loginController->doControl();
        }
        $this->layoutView->render($this->loginModel->isLoggedIn($this->loginView->getUserClient()), $this->loginView, $this->dateTimeView, $this->navigationView, $this->registrationView);

    }
}