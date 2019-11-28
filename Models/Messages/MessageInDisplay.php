<?php


class MessageInDisplay extends Message
{
    private $_mboxID, $_mailbox, $_firstName, $_lastName;

    public function __construct($dbRow)
    {
        parent::__construct($dbRow);

        $this->_mboxID = $dbRow['mboxID'];
        $this->_mailbox = $dbRow['mailbox'];
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
    }

    public function getMboxID()
    {
        return $this->_mboxID;
    }

    public function getMailbox()
    {
        return $this->_mailbox;
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }


    public function getLastName()
    {
        return $this->_lastName;
    }
}