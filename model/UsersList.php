<?php
namespace model;
require_once("usersDAL.php");

class UsersList{
    private $users = array();
    private $usersDAL;

    public function __construct(\mysqli $db){
        $this->usersDAL = new usersDAL($db);
        $this->users = $this->usersDAL->getUser();
    }
public function add($username) {
    foreach ($this->users as $user) {
        if ($username == $user) {
            throw new \Exception("You cannot have two users with the same username");
        }
    }
    $this->users[] = $username;
}
    public function getAllUsers(){
        return $this->users;
    }
    public function getPassword($username){
        return $this->usersDAL->getUserPassword($username);
    }
}