<?php

require_once '../../admin/dbconnect/dbconnection.php';
require_once '../../admin/models/Message.php';

class MessageController
{
    private $link;

    function __construct()
    {
        $dbconnect = new DBConnect();
        $this->link = $dbconnect->InitConnect();
    }

    function SendMessage($content, $createdate, $sendid, $receiveid)
    {
        $sql = "INSERT INTO Messages (Content, CreateDate, SendID, ReceiveID, Seen) 
            VALUES ('{$content}', '{$createdate}', '{$sendid}', '{$receiveid}', FALSE)";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function GetSentMessages($sendid, $receiveid)
    {
        $messageList = [];
        $sql = "SELECT * FROM Messages WHERE SendID={$sendid} AND ReceiveID={$receiveid} ORDER BY CreateDate DESC";

        $rs = $this->link->query($sql);

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $mess = new Message();
                $mess->setMessageID($row["MessageID"]);
                $mess->setContent($row["Content"]);
                $mess->setCreateDate(date("H:i  d-m-Y", strtotime($row["CreateDate"])));
                $mess->setSeen($row["Seen"]);

                array_push($messageList, $mess);
            }
        }

        return $messageList;
    }

    function GetReceiveMessages($receiveid)
    {
        // SELECT MessageID, Content, Users.FullName, Seen FROM Messages,Users WHERE Messages.SendID = Users.UserID AND Messages.ReceiveID = 12
        $messageList = [];
        $sql = "SELECT MessageID, Content, CreateDate,Users.FullName, Seen FROM Messages,Users WHERE Messages.SendID = Users.UserID AND Messages.ReceiveID = {$receiveid} ORDER BY CreateDate DESC";

        $rs = $this->link->query($sql);

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $mess = new Message();
                $mess->setMessageID($row["MessageID"]);
                $mess->setContent($row["Content"]);
                // $mess->setCreateDate($row["CreateDate"]);
                $mess->setCreateDate(date("H:i  d-m-Y", strtotime($row["CreateDate"])));
                $mess->setSendName($row["FullName"]);
                $mess->setSeen($row["Seen"]);

                array_push($messageList, $mess);
            }
        }

        return $messageList;
    }

    // Delete message
    function DeleteMessage($messageId)
    {
        $sql = "DELETE FROM Messages WHERE MessageID={$messageId}";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Update message
    function UpdateMessage($messid, $newmessage)
    {
        $sql = "UPDATE Messages SET Content='{$newmessage}' WHERE MessageID={$messid}";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
