<?php


class Post
{
    private $_postID, $_title, $_postMessage, $_postDate, $_topicSubject, $_postingUser, $_image;

    public function __construct($dbRow)
    {
        $this->_postID = $dbRow['postID'];
        $this->_title = $dbRow['title'];
        $this->_postMessage = $dbRow['content'];
        $this->_postDate = $dbRow['postDate'];
        $this->_topicSubject = $dbRow['topicSubject'];
        $this->_postingUser = $dbRow['postingUser'];
        $this->_image = $dbRow['image'];
    }

    public function getPostID()
    {
        return $this->_postID;
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

    public function getPostMessage()
    {
        return $this->_postMessage;
    }

    public function getPostDate()
    {
        return $this->_postDate;
    }

    public function getImage()
    {
        return $this->_image;
    }
}