<?php
 /**
  * Solution for assignment 2
  * @author Daniel Toll
  */
require_once("Settings.php.default");
require_once("controller/LoginController.php");
require_once("controller/MasterController.php");
require_once("view/LayoutView.php");

if (Settings::DISPLAY_ERRORS) {
	error_reporting(-1);
	ini_set('display_errors', 'ON');
}

//session must be started before LoginModel is created
session_start();

//Create master controller and Handle Input
$mc= new \controller\MasterController();
$mc->HandleInput();