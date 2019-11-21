<?php


class Reply
{
    private $_replyID, $_replyMessage, $_replyDate, $_replyFrom, $_replyTo, $_replyImage, $_postID;

    public function __construct($dbRow) {

        $this->_replyID = $dbRow['replyID'];
        $this->_replyMessage = $dbRow['replyMessage'];
        $this->_replyDate = $dbRow['replyDate'];
        $this->_replyFrom = $dbRow['replyFrom'];
        $this->_replyTo = $dbRow['replyTo'];
        $this->_replyImage = $dbRow['replyImage'];
        $this->_postID = $dbRow['postID'];
    }

    public function getReplyID()
    {
        return $this->_replyID;
    }

    public function getReplyMessage()
    {
        return $this->_replyMessage;
    }

    public function getReplyDate()
    {
        return $this->_replyDate;
    }

    public function getReplyFrom()
    {
        return $this->_replyFrom;
    }

    public function getReplyTo()
    {
        return $this->_replyTo;
    }

    public function getReplyImage()
    {
        return $this->_replyImage;
    }

    public function getPostID()
    {
        return $this->_postID;
    }
}