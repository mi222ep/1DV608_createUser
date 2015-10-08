<?php
namespace model;
class RegisterCredentials{
    private $username;
    private $password;
    private $passwordRepeat;

    public function __construct($username, $password, $passwordRepeat){
        $this->username = $username;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }
    public function getName(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getPasswordRepeat(){
        return $this->passwordRepeat;
    }
}