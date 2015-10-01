<?php
 /**
  * Solution for assignment 2
  * @author Daniel Toll
  */
require_once("Settings.php.default");
require_once("controller/LoginController.php");
require_once("controller/MasterController.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");

if (Settings::DISPLAY_ERRORS) {
	error_reporting(-1);
	ini_set('display_errors', 'ON');
}

//session must be started before LoginModel is created
session_start(); 

//Dependency injection
$m = new \model\LoginModel();
$v = new \view\LoginView($m);
$c = new \controller\LoginController($m, $v);


//Controller must be run first since state is changed


//Generate output
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();
$mc= new \controller\MasterController($v, $dtv);
$mc->HandleInput();
$c->doControl();
//$lv->render($m->isLoggedIn($v->getUserClient()), $v, $dtv);