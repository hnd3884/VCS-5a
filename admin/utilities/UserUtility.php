<?php

class UserUtility{
    public static function CheckPhone($phonenumber){
        if(ctype_digit($phonenumber)){
            return true;
        }
        return false;
    }
}