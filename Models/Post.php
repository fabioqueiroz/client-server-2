<?php


class Post
{
    private $_postID, $_postingUser, $_subject, $_message, $_image;

    public function __construct($dbRow)
    {
        $this->_postID = $dbRow['postID'];
        $this->_postingUser = $dbRow['postingUser'];
        $this->_subject = $dbRow['subject'];
        $this->_message = $dbRow['message'];
        $this->_image = $dbRow['image'];
    }

    public function getPostID()
    {
        return $this->_postID;
    }

    public function getPostingUser()
    {
        return $this->_postingUser;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getImage()
    {
        return $this->_image;
    }
}