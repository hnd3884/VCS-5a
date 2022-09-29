<?php

require_once '../../admin/dbconnect/dbconnection.php';
require_once '../../admin/models/Challenge.php';
require_once '../../admin/models/History.php';

class HistoryController
{
    private $link;

    function __construct()
    {
        $dbconnect = new DBConnect();
        $this->link = $dbconnect->InitConnect();
    }

    function AddHistory($studentid, $result, $submitdate, $challengeid)
    {
        // INSERT INTO Histories (StudentID, Result, SubmitDate, ChallengeID) VALUES (12,TRUE, '2020-09-24 17:30:02', 12)
        $sql = "";
        if ($result) {
            $sql = "INSERT INTO Histories (StudentID, Result, SubmitDate, ChallengeID) 
            VALUES ({$studentid},TRUE, '{$submitdate}', {$challengeid})";
        } else {
            $sql = "INSERT INTO Histories (StudentID, Result, SubmitDate, ChallengeID) 
            VALUES ({$studentid},FALSE, '{$submitdate}', {$challengeid})";
        }


        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function LoadHistory($chalid){
        $histories = [];
        $sql = "SELECT * FROM Histories,Users WHERE Histories.StudentID = Users.UserID AND Histories.ChallengeID = {$chalid}";

        $rs = $this->link->query($sql);

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $his = new History();
                $his->setHistoryID($row["HistoryID"]);
                $his->setResult($row["Result"]);
                $his->setSubmitDate(date("H:i  d-m-Y", strtotime($row["SubmitDate"])));
                $his->setStudentName($row["FullName"]);

                array_push($histories, $his);
            }
        }

        return $histories;
    }
}
