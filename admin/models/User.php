<?php

class User {

    private $UserID;
    private $UserName;
    private $Password;
    private $FullName;
    private $PhoneNumber;
    private $Email;
    private $Role;

    function getRole() {
        return $this->Role;
    }

    function setRole($Role): void {
        $this->Role = $Role;
    }

    function getFullName() {
        return $this->FullName;
    }

    function getPhoneNumber() {
        return $this->PhoneNumber;
    }

    function getEmail() {
        return $this->Email;
    }

    function getUserID() {
        return $this->UserID;
    }

    function getUserName() {
        return $this->UserName;
    }

    function getPassword() {
        return $this->Password;
    }

    function setUserID($UserID): void {
        $this->UserID = $UserID;
    }

    function setUserName($UserName): void {
        $this->UserName = $UserName;
    }

    function setPassword($Password): void {
        $this->Password = $Password;
    }

    function setFullName($FullName): void {
        $this->FullName = $FullName;
    }

    function setPhoneNumber($PhoneNumber): void {
        $this->PhoneNumber = $PhoneNumber;
    }

    function setEmail($Email): void {
        $this->Email = $Email;
    }

}
