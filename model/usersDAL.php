<?php
namespace model;
class usersDAL{
    public function __construct(\mysqli $db){
    $this->database = $db;
}
public function getUser() {
    $users = array();
    $stmt = $this->database->prepare("SELECT username FROM users");
    if ($stmt === FALSE) {
        throw new \Exception($this->database->error);
    }
    $stmt->execute();

    $stmt->bind_result($username);
    while ($stmt->fetch()) {
        $users[] = $username;
    }
    return  $users;
}
    public function getUserPassword($username){
        $temp ="";
        $stmt = $this->database->prepare("select password from users where username ='$username'");
        if ($stmt === FALSE) {
            throw new \Exception($this->database->error);
        }
        $stmt->execute();
        $stmt->bind_result($password);
        while ($stmt->fetch()) {
            $temp = $password;
        }
        return $temp;
    }
    public function addUser($username, $password){
        $stmt = $this->database->prepare("INSERT INTO `users`(`username`, `password`) VALUES ([$username],[$password])");
        if ($stmt === FALSE) {
            return false;
        }
        $stmt->execute();
        return true;
    }
}