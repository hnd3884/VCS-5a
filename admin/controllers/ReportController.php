<?php

require_once '../../admin/dbconnect/dbconnection.php';
require_once '../../admin/models/Report.php';

class ReportController
{
    private $link;

    function __construct()
    {
        $dbconnect = new DBConnect();
        $this->link = $dbconnect->InitConnect();
    }

    function AddReport($filepath, $studentid, $createdate, $assignmentid, $filename)
    {
        $sql = "INSERT INTO Reports (StudentID, FilePath, CreateDate, AssignmentID, FileName) 
            VALUES ('{$studentid}', '{$filepath}', '{$createdate}', '{$assignmentid}', '{$filename}')";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function GetAllReports($assignid)
    {
        $reportList = [];
        $sql = "SELECT Reports.*, Users.FullName FROM Reports, Users WHERE StudentID=UserID AND AssignmentID=" . $assignid;

        $rs = $this->link->query($sql);

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $rp = new Report();
                $rp->setAssignmentID($row["AssignmentID"]);
                $rp->setFilePath($row["FilePath"]);
                $rp->setCreateDate(date("H:i d-m-Y", strtotime($row["CreateDate"])));
                $rp->setStudentName($row["FullName"]);
                $rp->setStudentID($row["StudentID"]);
                $rp->setFileName($row["FileName"]);

                array_push($reportList, $rp);
            }
        }

        return $reportList;
    }

    function GetReportOfStudent($assignid, $studentid)
    {
        $sql = "SELECT Reports.*, Users.FullName FROM Reports, Users WHERE StudentID=UserID AND AssignmentID=" . $assignid . " AND StudentID=" . $studentid;

        $rs = $this->link->query($sql);

        if ($rs->num_rows > 0) {
            $row = $rs->fetch_assoc();

            $rp = new Report();
            $rp->setReportID($row["ReportID"]);
            $rp->setAssignmentID($row["AssignmentID"]);
            $rp->setFilePath($row["FilePath"]);
            $rp->setCreateDate(date("H:i d-m-Y", strtotime($row["CreateDate"])));
            $rp->setStudentName($row["FullName"]);
            $rp->setStudentID($row["StudentID"]);
            $rp->setFileName($row["FileName"]);

            return $rp;
        }

        return null;
    }

    function ChangeReport($reportid, $filepath, $filename)
    {
        $sql = "UPDATE Reports SET FilePath='{$filepath}', FileName='{$filename}' WHERE ReportID={$reportid}";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
