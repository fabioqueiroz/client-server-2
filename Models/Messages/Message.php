<?php


class Message
{
    private $_messageID, $_message, $_sentBy, $_sentTo, $_messageDate;

    public function __construct($dbRow)
    {
        $this->_messageID = $dbRow['messageID'];
        $this->_message = $dbRow['message'];
        $this->_sentBy = $dbRow['sentBy'];
        $this->_sentTo = $dbRow['sentTo'];
        $this->_messageDate = $dbRow['messageDate'];
    }

    public function getMessageID()
    {
        return $this->_messageID;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getSentBy()
    {
        return $this->_sentBy;
    }

    public function getSentTo()
    {
        return $this->_sentTo;
    }

    public function getMessageDate()
    {
        return $this->_messageDate;
    }

}