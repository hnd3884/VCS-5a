<?php

class Message
{
    private $MessageID;
    private $Content;
    private $CreateDate;
    private $SendID;
    private $SendName;
    private $ReceiveID;
    private $Seen;

    function getSendName()
    {
        return $this->SendName;
    }
    function getMessageID()
    {
        return $this->MessageID;
    }
    function getContent()
    {
        return $this->Content;
    }
    function getCreateDate()
    {
        return $this->CreateDate;
    }
    function getSendID()
    {
        return $this->SendID;
    }
    function getReceiveID()
    {
        return $this->ReceiveID;
    }
    function getSeen()
    {
        return $this->Seen;
    }

    function setSendName($SendName): void
    {
        $this->SendName = $SendName;
    }
    function setMessageID($MessageID): void
    {
        $this->MessageID = $MessageID;
    }
    function setContent($Content): void
    {
        $this->Content = $Content;
    }
    function setCreateDate($CreateDate): void
    {
        $this->CreateDate = $CreateDate;
    }
    function setSendID($SendID): void
    {
        $this->SendID = $SendID;
    }
    function setReceiveID($ReceiveID): void
    {
        $this->ReceiveID = $ReceiveID;
    }
    function setSeen($Seen): void
    {
        $this->Seen = $Seen;
    }
}
