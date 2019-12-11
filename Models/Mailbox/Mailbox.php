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

    /**
     * @return the mailbox item's id
     */
    public function getMboxID()
    {
        return $this->_mboxID;
    }

    /**
     * @return the user's id
     */
    public function getMboxUser()
    {
        return $this->_mboxUser;
    }

    /**
     * @return an "In" or "Out" string
     */
    public function getMailbox()
    {
        return $this->_mailbox;
    }

    /**
     * @return the foreign key
     */
    public function getMessageID()
    {
        return $this->_messageID;
    }

}