<?php


class Post
{
    private $_ID, $_title, $_message, $_messageDate, $_topicSubject, $_postingUser;//, $_image;

    public function __construct($dbRow)
    {
        $this->_ID = $dbRow['ID'];
        $this->_title = $dbRow['title'];
        $this->_message = $dbRow['message'];
        $this->_messageDate = $dbRow['messageDate'];
        $this->_topicSubject = $dbRow['topicSubject'];
        $this->_postingUser = $dbRow['postingUser'];
    }

    public function getID()
    {
        return $this->_ID;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getPostingUser()
    {
        return $this->_postingUser;
    }

    public function getTopicSubject()
    {
        return $this->_topicSubject;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getMessageDate()
    {
        return $this->_messageDate;
    }

}