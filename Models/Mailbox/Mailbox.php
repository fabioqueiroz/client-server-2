<?php


class Mailbox
{
    private $_mboxID, $_mboxUser, $_mailbox, $_messageID;

    public function __construct($dbRow)
    {
        $this->_mboxID = $dbRow['mboxID'];
        $this->_mboxUser = $dbRow['mboxUser'];
        $this->_mailbox = $dbRow['mailbox'];
        $this->_messageID = $dbRow['messageID'];
    }

    public function getMboxID()
    {
        return $this->_mboxID;
    }

    public function getMboxUser()
    {
        return $this->_mboxUser;
    }

    public function getMailbox()
    {
        return $this->_mailbox;
    }

    public function getMessageID()
    {
        return $this->_messageID;
    }

}