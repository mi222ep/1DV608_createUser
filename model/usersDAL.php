<?php
namespace model;
class usersDAL{
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
        $this->users[] = $username;
    }
    return  $this->users;
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
}