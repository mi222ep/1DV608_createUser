<?php
namespace view;
class NavigationView{
    private static $newUserURL = "register";

    public function isNewUserSet(){
        return ISSET($_GET[self::$newUserURL]);
    }
    public function makeLink($text){
        return "<a href='?". self::$newUserURL."=1'>$text</a>";
    }
    public function getReturnLink(){
        return "<a href='?'>Back to login</a>";
    }
}