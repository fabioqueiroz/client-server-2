<?php


class Reply
{
    private $_replyID, $_replyMessage, $_replyDate, $_replyFrom, $_replyTo, $_postID;

    public function __construct($dbRow) {

        $this->_replyID = $dbRow['replyID'];
        $this->_replyMessage = $dbRow['replyMessage'];
        $this->_replyDate = $dbRow['replyDate'];
        $this->_replyFrom = $dbRow['replyFrom'];
        $this->_replyTo = $dbRow['replyTo'];
        $this->_postID = $dbRow['postID'];
    }

    /**
     * @return the reply id
     */
    public function getReplyID()
    {
        return $this->_replyID;
    }

    /**
     * @return the message
     */
    public function getReplyMessage()
    {
        return $this->_replyMessage;
    }

    /**
     * @return the datetime information
     */
    public function getReplyDate()
    {
        return $this->_replyDate;
    }

    /**
     * @return the id of the sender
     */
    public function getReplyFrom()
    {
        return $this->_replyFrom;
    }

    /**
     * @return the id of the receiver
     */
    public function getReplyTo()
    {
        return $this->_replyTo;
    }

    /**
     * @return the foreign key
     */
    public function getPostID()
    {
        return $this->_postID;
    }
}