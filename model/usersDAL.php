<?php
namespace model;
class usersDAL{
    private $username;
    public function __construct(\mysqli $db){
    $this->database = $db;
}
public function getUser() {
    $stmt = $this->database->prepare("SELECT username FROM users");
    if ($stmt === FALSE) {
        throw new \Exception($this->database->error);
    }
    $stmt->execute();

    $stmt->bind_result($username);
    while ($stmt->fetch()) {
        $this->username=$username;
    }
    return  $this->username;
}
    public function getUserPassword($username){
        $stmt = $this->database->prepare("select * from users where username =$username");
        if ($stmt === FALSE) {
            throw new \Exception($this->database->error);
        }
        $stmt->execute();
        $stmt->bind_result($password);
        return $password;
    }
}