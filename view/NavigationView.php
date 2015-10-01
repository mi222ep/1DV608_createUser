<?php
namespace view;
class NavigationView{
    private static $newUserURL = "newUser";

    public function isNewUserSet(){
        return ISSET($_GET[self::$newUserURL]);
    }
}