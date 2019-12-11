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

    /**
     * @return the post id
     */
    public function getID()
    {
        return $this->_ID;
    }

    /**
     * @return the post title
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return the id of the
     * user who's posting
     */
    public function getPostingUser()
    {
        return $this->_postingUser;
    }

    /**
     * @return the id of the linked topic
     */
    public function getTopicSubject()
    {
        return $this->_topicSubject;
    }

    /**
     * @return the string that
     * contains the message
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @return the datetime information
     */
    public function getMessageDate()
    {
        return $this->_messageDate;
    }

}