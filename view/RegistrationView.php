<?php
namespace view;
require_once("model/RegisterCredentials.php");

class RegistrationView{
    private static $message = "RegisterView::Message";
    private static $username = "RegisterView::UserName";
    private static $password = "RegisterView::Password";
    private static $passwordRepeat = "RegisterView::PasswordRepeat";
    private static $submitForm = "RegisterView::Register";

    private $registrationFail = false;
    private $usersList;

    public function __construct( \model\UsersList $usersList){
        $this->usersList = $usersList;
    }
    public function response() {
        return $this->doRegistrationForm();
    }
    private function doRegistrationForm(){
        $message = "";
        if($this->registrationFail){
            if($this->getRequestUserName() == null || $this->userNameIsTooShort()){
                $message .= "Username has too few characters, at least 3 characters.";
            }
            if($this->getPassword() == null || $this->passwordIsTooShort()){
                $message .= "Password has too few characters, at least 6 characters.";
            }
            else{
                if($this->passwordsAreDifferent()){
                    $message .= "Passwords do not match.";
                }
                elseif($this->illegalCharactersInUsername()){
                    $message .= "Username contains invalid characters.";
                }
                elseif($this->usersList->isUserExistInDB($this->getRequestUserName())){
                    $message .="User exists, pick another username.";
                }
            }
        }

        return $this->generateRegistrationFormHTML($message);
    }
    private function generateRegistrationFormHTML($message){
        return "<form method='post' >
				<fieldset>
					<legend>Register a new user - write username and Password</legend>
					<p id='".self::$message."'>$message</p>
					<label for='".self::$username."'>Username :</label>
					<input type='text' id='".self::$username."' name='".self::$username."' value='".$this->getRequestUserName()."'/><br>
					<label for='".self::$password."'>Password :</label>
					<input type='password' id='".self::$password."' name='".self::$password."'/><br>
                    <label for='".self::$passwordRepeat."'>Repeat Password :</label>
					<input type='password' id='".self::$passwordRepeat."' name='".self::$passwordRepeat."'/><br>

					<input type='submit' name='".self::$submitForm."' value='Submit'/>
				</fieldset>
			</form>
		";
}
    public function getRequestUserName() {
        if (isset($_POST[self::$username]))
            return strip_tags($_POST[self::$username]);
        return "";
    }
    public function userWantsToRegister(){
        return isset($_POST[self::$submitForm]);
    }
    public function setRegistrationFail(){
        $this->registrationFail = true;
    }
    public function userNameIsTooShort(){
        $userName = $_POST[self::$username];
        if(mb_strlen($userName)<3){
            return true;
        }
        return false;
    }
    public function passwordIsTooShort(){
        $password = $_POST[self::$password];
        if(mb_strlen($password)<6){
            return true;
        }
        return false;
    }
    public function userNameGotInvalidCharacters(){
        return false;
    }
    public function passwordsAreDifferent(){
         return $_POST[self::$password] != $_POST[self::$passwordRepeat];
    }
    private function illegalCharactersInUsername(){
        return $_POST[self::$username] != $this->getRequestUserName();
    }
    private function getPassword(){
        if (isset($_POST[self::$password]))
            return $_POST[self::$password];
        return "";
    }
    private function getPasswordRepeat(){
        if (isset($_POST[self::$passwordRepeat]))
            return $_POST[self::$passwordRepeat];
        return "";
    }
    public function getRegistrationCredentials(){
        return new \model\RegisterCredentials($this->getRequestUserName(),
            $this->getPassword(),
            $this->getPasswordRepeat());
    }

}