<?php
namespace model;
class UsersList{
    private $users = array();

public function add($username) {
    foreach ($this->users as $user) {
        if ($username == $user) {
            throw new \Exception("You cannot have two products with the same id");
        }
    }
    $this->users[] = $username;
}
    public function getAllUsers(){
        return $this->users;
    }
}