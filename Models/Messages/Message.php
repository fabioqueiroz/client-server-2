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

    /**
     * @return the message id
     */
    public function getMessageID()
    {
        return $this->_messageID;
    }

    /**
     * @return the string
     * containing the message
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @return the id of the sender
     */
    public function getSentBy()
    {
        return $this->_sentBy;
    }

    /**
     * @return the id of the receiver
     */
    public function getSentTo()
    {
        return $this->_sentTo;
    }

    /**
     * @return the datetime informatio
     */
    public function getMessageDate()
    {
        return $this->_messageDate;
    }

}