<?php

class History{
    private $HistoryID;
    private $StudentID;
    private $Result;
    private $SubmitDate;
    private $ChallengeID;
    private $StudentName;

    function getStudentName()
    {
        return $this->StudentName;
    }
    function setStudentName($StudentName): void
    {
        $this->StudentName = $StudentName;
    }
    function getChallengeID()
    {
        return $this->ChallengeID;
    }
    function getHistoryID()
    {
        return $this->HistoryID;
    }
    function getStudentID()
    {
        return $this->StudentID;
    }
    function getResult()
    {
        return $this->Result;
    }
    function getSubmitDate()
    {
        return $this->SubmitDate;
    }
    

    function setSubmitDate($SubmitDate): void
    {
        $this->SubmitDate = $SubmitDate;
    }

    function setResult($Result): void
    {
        $this->Result = $Result;
    }

    function setChallengeID($ChallengeID): void
    {
        $this->ChallengeID = $ChallengeID;
    }
    function setHistoryID($HistoryID): void
    {
        $this->HistoryID = $HistoryID;
    }
    function setStudentID($StudentID): void
    {
        $this->StudentID = $StudentID;
    }
}