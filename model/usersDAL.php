<?php
namespace model;
class usersDAL{
    private $username;
    private $password;
    public function __construct(\mysqli $db){
    $this->database = $db;
}
public function getUser() {
    $stmt = $this->database->prepare("SELECT * FROM users");
    if ($stmt === FALSE) {
        throw new \Exception($this->database->error);
    }
    $stmt->execute();

    $stmt->bind_result($id, $username, $password);
    while ($stmt->fetch()) {
        $this->username=$username;
        $this->pasword = $password;
    }
    return  $this->username;
}
}