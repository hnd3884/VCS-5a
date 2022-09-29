<?php

class Role
{
    private $RoleID;
    private $Description;

    function getRoleID()
    {
        return $this->RoleID;
    }

    function getDescription()
    {
        return $this->Description;
    }

    function setRoleID($RoleID): void
    {
        $this->RoleID = $RoleID;
    }

    function setDescription($Description): void
    {
        $this->Description = $Description;
    }
}
