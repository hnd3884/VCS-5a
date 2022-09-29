<?php

class Report
{
    private $ReportID;
    private $FilePath;
    private $CreateDate;
    private $AssignmentID;
    private $StudentID;
    private $StudentName;
    private $FileName;

    function getFileName()
    {
        return $this->FileName;
    }
    function getAssignmentID()
    {
        return $this->AssignmentID;
    }
    function getStudentName()
    {
        return $this->StudentName;
    }
    function getStudentID()
    {
        return $this->StudentID;
    }
    function getCreateDate()
    {
        return $this->CreateDate;
    }
    function getFilePath()
    {
        return $this->FilePath;
    }
    function getReportID()
    {
        return $this->ReportID;
    }

    function setAssignmentID($AssignmentID): void
    {
        $this->AssignmentID = $AssignmentID;
    }
    function setCreateDate($CreateDate): void
    {
        $this->CreateDate = $CreateDate;
    }
    function setFilePath($FilePath): void
    {
        $this->FilePath = $FilePath;
    }
    function setReportID($ReportID): void
    {
        $this->ReportID = $ReportID;
    }
    function setStudentName($StudentName): void
    {
        $this->StudentName = $StudentName;
    }
    function setStudentID($StudentID): void
    {
        $this->StudentID = $StudentID;
    }
    function setFileName($FileName): void
    {
        $this->FileName = $FileName;
    }
}