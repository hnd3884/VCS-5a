<?php

require_once '../../admin/dbconnect/dbconnection.php';
require_once '../../admin/models/Challenge.php';
require_once '../../public/config/routes.php';
require_once 'HistoryController.php';
require_once '../../admin/utilities/FolderUtility.php';

class ChallengeController
{
    private $link;

    function __construct()
    {
        $dbconnect = new DBConnect();
        $this->link = $dbconnect->InitConnect();
    }

    function AddChallenge($challengename, $hint, $folder)
    {
        $sql = "INSERT INTO Challenges (ChallengeName, Hint,  Folder) 
            VALUES ('{$challengename}','{$hint}', '{$folder}')";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function GetAllChallenge()
    {
        $sql = "SELECT * FROM Challenges";
        $challenges = [];

        $rs = $this->link->query($sql);

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $chal = new Challenge();
                $chal->setChallengeID($row["ChallengeID"]);
                $chal->setChallengeName($row["ChallengeName"]);

                array_push($challenges, $chal);
            }
        }

        return $challenges;
    }

    function GetChallengeById($chalid)
    {
        $sql = "SELECT * FROM Challenges WHERE ChallengeID=" . $chalid;

        $rs = $this->link->query($sql);
        $row = $rs->fetch_assoc();

        $chal = new Challenge();
        $chal->setChallengeID($row["ChallengeID"]);
        $chal->setChallengeName($row["ChallengeName"]);
        $chal->setHint($row["Hint"]);
        $chal->setFolder($row["Folder"]);

        $folder = $row["Folder"];
        $filepath = $_SERVER['DOCUMENT_ROOT'] . ROUTE_CHALLENGE_FILE . $folder . "/";
        $output = shell_exec('ls ' . $filepath);
        $filename = substr($output, 0, strrpos($output, "."));
        $filepath = ROUTE_CHALLENGE_FILE . $folder . "/" . trim($output);

        $chal->setFilePath($filepath);
        $chal->setFileName($filename);

        $historyController = new HistoryController();
        $chal->setHistories($historyController->LoadHistory($chalid));

        return $chal;
    }

    function DeleteChallenge($chalid)
    {
        $chal = $this->GetChallengeById($chalid);
        $folder = $chal->getFolder();
        $folderPath = $_SERVER['DOCUMENT_ROOT'] . ROUTE_CHALLENGE_FILE . $folder . "/";
        FolderUtility::DeleteDir($folderPath);

        $sql = "DELETE FROM Challenges WHERE ChallengeID=" . $chalid;

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function CheckAnswer($chalid, $answer)
    {
        $sql = "SELECT * FROM Challenges WHERE ChallengeID=" . $chalid;

        $rs = $this->link->query($sql);
        $row = $rs->fetch_assoc();

        $folder = $row["Folder"];
        $filepath = $_SERVER['DOCUMENT_ROOT'] . ROUTE_CHALLENGE_FILE . $folder . "/";
        $output = shell_exec('ls ' . $filepath);
        $filename = substr($output, 0, strrpos($output, "."));

        if ($filename == $answer) {
            return 1;
        } else {
            return 0;
        }

        // $sql = "SELECT * FROM Challenges WHERE ChallengeID=" . $chalid;

        // $rs = $this->link->query($sql);
        // $row = $rs->fetch_assoc();

        // $folder = $row["Folder"];
        // $filepath = $_SERVER['DOCUMENT_ROOT'] . ROUTE_CHALLENGE_FILE . $folder . "/";
        // $output = scandir($filepath);
        // $filename = substr($output[2], 0, strrpos($output[2], "."));

        // if ($filename == $answer) {
        //     return 1;
        // } else {
        //     return 0;
        // }
    }
}
