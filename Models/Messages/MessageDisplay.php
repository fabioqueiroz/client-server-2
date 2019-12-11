<?php


class MessageDisplay extends Message
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

    /**
     * @return the mailbox id
     * coming from the inner join
     */
    public function getMboxID()
    {
        return $this->_mboxID;
    }

    /**
     * @return the mailbox type
     * coming from the inner join
     */
    public function getMailbox()
    {
        return $this->_mailbox;
    }

    /**
     * @return the user's first name
     * coming from the inner join
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @return the user's last name
     * coming from the inner join
     */
    public function getLastName()
    {
        return $this->_lastName;
    }
}