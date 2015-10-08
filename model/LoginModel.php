<?php
/**
  * Solution for assignment 2
  * @author Daniel Toll
  */
namespace model;

require_once("UserCredentials.php");
require_once("TempCredentials.php");
require_once("TempCredentialsDAL.php");
require_once("LoggedInUser.php");
require_once("UserClient.php");
require_once("UsersList.php");



class LoginModel {

	//TODO: Remove static to enable several sessions
	private static $sessionUserLocation = "LoginModel::loggedInUser";

	/**
	 * @var null | TempCredentials
	 */
	private $tempCredentials = null;

	private $tempDAL;

	private $usersList;

	public function __construct(\mysqli $db) {
		self::$sessionUserLocation .= \Settings::APP_SESSION_NAME;

		if (!isset($_SESSION)) {
			//Alternate check with newer PHP
			//if (\session_status() == PHP_SESSION_NONE) {
			assert("No session started");
		}
		$this->tempDAL = new TempCredentialsDAL();
		$this->usersList = new UsersList($db);
	}

	/**
	 * Checks if user is logged in
	 * @param  UserClient $userClient The current calls Client
	 * @return boolean                true if user is logged in.
	 */
	public function isLoggedIn(UserClient $userClient) {
		if (isset($_SESSION[self::$sessionUserLocation])) {
			$user = $_SESSION[self::$sessionUserLocation];

			if ($user->sameAsLastTime($userClient) == false) {
				return false;
			}
			return true;
		} 

		return false;
	}

	/**
	 * Attempts to authenticate
	 * @param  UserCredentials $uc
	 * @return boolean
	 */
	public function doLogin(UserCredentials $uc) {
		$this->tempCredentials = $this->tempDAL->load($uc->getName());
		$existingUser = null;
		if($this->isUserInDB($uc->getName())){
			$existingUser = $uc->getName();
		}
		$loginByUsernameAndPassword = $existingUser === $uc->getName() && $this->usersList->getPassword($existingUser) === $uc->getPassword();
		$loginByTemporaryCredentials = $this->tempCredentials != null && $this->tempCredentials->isValid($uc->getTempPassword());

		if ( $loginByUsernameAndPassword || $loginByTemporaryCredentials) {
			$user = new LoggedInUser($uc); 

			$_SESSION[self::$sessionUserLocation] = $user;

			return true;
		}
		return false;
	}

	public function doLogout() {
		unset($_SESSION[self::$sessionUserLocation]);
	}

	/**
	 * @return TempCredentials
	 */
	public function getTempCredentials() {
		return $this->tempCredentials;
	}

	/**
	 * renew the temporary credentials
	 * 
	 * @param  UserClient $userClient 
	 */
	public function renew(UserClient $userClient) {
		if ($this->isLoggedIn($userClient)) {
			$user = $_SESSION[self::$sessionUserLocation];
			$this->tempCredentials = new TempCredentials($user);
			$this->tempDAL->save($user, $this->tempCredentials);
		}
	}
	private function isUserInDB($username){
		$temp = $this->usersList->getAllUsers();
		foreach($temp as $user){
			if($user==$username){
				return true;
			}
		}
		return false;
	}
	
}