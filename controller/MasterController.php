<?php
namespace controller;

require_once("view/NavigationView.php");

class MasterController{

    private $navigationView;

    function __construct(){
        $this->navigationView = new \view\NavigationView();
    }
    public function HandleInput(){
        if($this->navigationView->isNewUserSet()){
            echo "new User set";
        }
        else{
            echo "no new User set";
        }
    }
    //If new user, load new user view
    //else, load Loginview
}