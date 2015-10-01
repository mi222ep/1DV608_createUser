<?php
namespace controller;

use view\LayoutView;

require_once("view/NavigationView.php");
require_once("view/LayoutView.php");

class MasterController{

    private $navigationView;
    private $layoutView;

    function __construct(\view\LoginView $model, \view\DateTimeView $view) {
        $this->model = $model;
        $this->view =  $view;
        $this->layoutView = new \view\LayoutView();
        $this->navigationView = new \view\NavigationView();
    }
    public function HandleInput(){
        if($this->navigationView->isNewUserSet()){
        }
        else{
            $this->layoutView->render(false, $this->model, $this->view, $this->navigationView);
        }
    }
    //If new user, load new user view
    //else, load Loginview
}