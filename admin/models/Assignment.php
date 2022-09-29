<?php

class Assignment
{
    private $AssignmentID;
    private $Description;
    private $FilePath;
    private $DueTo;
    private $FileName;

    function getAssignmentID()
    {
        return $this->AssignmentID;
    }
    function getFileName()
    {
        return $this->FileName;
    }
    function getDescription()
    {
        return $this->Description;
    }
    function getFilePath()
    {
        return $this->FilePath;
    }
    function getDueTo()
    {
        return $this->DueTo;
    }

    function setAssignmentID($AssignmentID): void
    {
        $this->AssignmentID = $AssignmentID;
    }
    function setDescription($Description): void
    {
        $this->Description = $Description;
    }
    function setFilePath($FilePath): void
    {
        $this->FilePath = $FilePath;
    }
    function setDueTo($DueTo): void
    {
        $this->DueTo = $DueTo;
    }
    function setFileName($FileName): void
    {
        $this->FileName = $FileName;
    }
}