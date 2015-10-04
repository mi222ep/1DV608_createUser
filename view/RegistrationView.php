<?php
namespace view;
class RegistrationView{
    private static $message = "RegisterView::Message";
    private static $username = "RegisterView::UserName";
    private static $password = "RegisterView::Password";
    private static $passwordRepeat = "RegisterView::PasswordRepeat";
    private static $submitForm = "RegisterView::Register";

    private $registrationFail = false;

    public function response() {
        return $this->doRegistrationForm();
    }
    private function doRegistrationForm(){
        $message = "";
        if($this->registrationFail){
            if($_POST[self::$username] == null || $this->userNameIsTooShort()){
                $message .= "Username has too few characters, at least 3 characters.";
            }
            if($_POST[self::$password] == null){
                $message .= "Password has too few characters, at least 6 characters.";
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
    public function getRequestUserName(){
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
    public function userNameGotInvalidCharacters(){
        return false;
    }
}